<?php

declare(strict_types=1);

namespace App\Facade;

use App\Dto\IdentifiedBoxListFactory;
use App\Entity\Packaging;
use App\Packaging\PackagingResolver;
use App\Request\PackagingRequest;

class ApplicationFacade
{

    public function __construct(
        readonly private IdentifiedBoxListFactory $identifiedBoxListFactory,
        readonly private PackagingResolver $packagingResolver,
    )
    {
    }

    public function handleRequest(
        PackagingRequest $packagingRequest
    ): Packaging
    {
        $boxes = $this->identifiedBoxListFactory->createFromPackagingRequest($packagingRequest);
        return $this->packagingResolver->solveBoxSize($boxes);
    }

}
