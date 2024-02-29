<?php

declare(strict_types = 1);

namespace App\Api\BinPacking;

use App\Api\BinPacking\Exception\BinPackingStatusNotOkException;
use App\Api\BinPacking\Exception\ItemsCountMismatchException;
use App\Api\BinPacking\Exception\MoreThanOneBinNeededException;
use App\Api\BinPacking\Exception\NoBinFoundException;
use App\Api\BinPacking\Request\BinPackingRequestFactory;
use App\Api\BinPacking\Response\FindBoxSizeResponseResponse;
use App\Dto\IdentifiedBoxList;
use App\Entity\Packaging;
use App\Repository\PackagingRepository;

class BinPackingClientFacade
{

    public function __construct(
        private readonly PackagingRepository $packagingRepository,
        private readonly BinPackingRequestFactory $binPackingRequestFactory,
        private readonly BinPackingClient $binPackingClient
    )
    {
    }

    public function getMinimalBoxSize(
        IdentifiedBoxList $boxList
    ): Packaging
    {
        $availablePackagings = $this->packagingRepository->findAll();
        $findBoxSizeRequest = $this->binPackingRequestFactory->createFindBoxSizeRequest(
            $availablePackagings,
            $boxList
        );

        $findBoxSizeResponse = $this->binPackingClient->getMinimalBoxSize($findBoxSizeRequest);

        if ($findBoxSizeResponse->getResponse()->getStatus() === FindBoxSizeResponseResponse::STATUS_NOT_OK) {
            throw new BinPackingStatusNotOkException();
        }

        if (count($findBoxSizeResponse->getResponse()->getBinsPacked()) === 0) {
            throw new NoBinFoundException();
        }

        if (count($findBoxSizeResponse->getResponse()->getBinsPacked()) > 1) {
            throw new MoreThanOneBinNeededException();
        }

        $binPacked = $findBoxSizeResponse->getResponse()->getBinsPacked()[0];
        if (count($binPacked->getItems()) !== count($boxList->getBoxes())) {
            throw new ItemsCountMismatchException();
        }

        return $this->packagingRepository->getById($binPacked->getBinData()->getId());
    }

}
