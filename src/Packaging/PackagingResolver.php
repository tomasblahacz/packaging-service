<?php

declare(strict_types = 1);

namespace App\Packaging;

use App\Api\BinPacking\BinPackingClientFacade;
use App\Api\BinPacking\Exception\BinPackingStatusNotOkException;
use App\Api\BinPacking\Exception\ItemsCountMismatchException;
use App\Api\BinPacking\Exception\MoreThanOneBinNeededException;
use App\Api\BinPacking\Exception\NoBinFoundException;
use App\Box\MinimalBoxParamsFacade;
use App\Dto\IdentifiedBoxList;
use App\Entity\Packaging;
use App\Factory\PackagingResolutionFactory;
use App\Packaging\Exception\NoAvailablePackageException;
use App\Repository\Exception\BoxSizeNotResolvedException;
use App\Repository\PackagingResolutionRepository;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

class PackagingResolver
{

    public function __construct(
        private readonly PackagingResolutionRepository $packingResolutionRepository,
        private readonly BinPackingClientFacade $binPackingClientFacade,
        private readonly PackagingResolutionFactory $packagingResolutionFactory,
        private readonly MinimalBoxParamsFacade $minimalBoxParamsFacade,
        private readonly LoggerInterface $logger
    )
    {
    }

    public function solveBoxSize(
        IdentifiedBoxList $boxes
    ): Packaging
    {
        $boxesDeterministicIdentifier = $boxes->getDeterministicIdentifier();

        try {
            $packagingResolution = $this->packingResolutionRepository->getByBoxListIdentifier(
                $boxesDeterministicIdentifier
            );
            return $packagingResolution->getPackaging();
        } catch (BoxSizeNotResolvedException) {
            // Not yet resolved and cached, load from API
        };

        try {
            $packaging = $this->binPackingClientFacade->getMinimalBoxSize($boxes);

            $packagingResolution = $this->packagingResolutionFactory->create(
                $boxesDeterministicIdentifier,
                $packaging,
            );
            $this->packingResolutionRepository->save($packagingResolution);

            return $packaging;
        } catch (BinPackingStatusNotOkException | MoreThanOneBinNeededException | NoBinFoundException $e) {
            // @todo refactor exceptions to extend common "non-recovarable" parent
            throw new NoAvailablePackageException($e->getMessage(), $e->getCode(), $e);
        } catch (GuzzleException | ItemsCountMismatchException $e) {
            // @todo refactor exceptions to extend common "recovarable" parent
            $this->logger->error(
                'Could not resolve box size using 3D Bin API',
                [
                    'exception' => $e::class,
                    'message' => $e->getMessage(),
                ]
            );

            return $this->minimalBoxParamsFacade->getMinimalPackaging($boxes);
        }
    }

}
