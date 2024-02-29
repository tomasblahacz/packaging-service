<?php

declare(strict_types = 1);

namespace App;

use App\Dto\IdentifiedBoxListFactory;
use App\Facade\ApplicationFacade;
use App\Http\JsonResponseFactory;
use App\Packaging\Exception\NoAvailablePackageException;
use App\Packaging\PackagingResolver;
use App\Request\PackagingRequestSerializer;
use App\Response\PackagingResponseFactory;
use App\Response\PackagingResponseSerializer;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class Application
{

    public function __construct(
        readonly private PackagingRequestSerializer $packagingRequestSerializer,
        readonly private PackagingResponseFactory $packagingResponseFactory,
        readonly private PackagingResponseSerializer $packagingResponseSerializer,
        readonly private JsonResponseFactory $jsonResponseFactory,
        readonly private LoggerInterface $logger,
        readonly private ValidatorInterface $validator,
        readonly private ApplicationFacade $applicationFacade
    )
    {
    }

    public function run(RequestInterface $request): ResponseInterface
    {
        $packagingRequest = $this->packagingRequestSerializer->deserialize(
            $request->getBody()->getContents()
        );

        $validationResult = $this->validator->validate($packagingRequest);
        if (count($validationResult) > 0) {
            return $this->jsonResponseFactory->createErrorFromMessage(400, 'Invalid request');
        }

        try {
            $response = $this->packagingResponseFactory->createResponse(
                $this->applicationFacade->handleRequest($packagingRequest)
            );
            return $this->jsonResponseFactory->create(200, $this->packagingResponseSerializer->serialize($response));
        } catch (NoAvailablePackageException $e) {
            return $this->jsonResponseFactory->createError(404, $e);
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage(), ['exception' => $e]);
            return $this->jsonResponseFactory->createError(500, $e);
        }
    }

}
