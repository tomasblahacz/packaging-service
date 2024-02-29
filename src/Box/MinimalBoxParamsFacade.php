<?php

declare(strict_types = 1);

namespace App\Box;

use App\Dto\BoxList;
use App\Dto\IdentifiedBoxList;
use App\Entity\Packaging;
use App\Repository\PackagingRepository;

class MinimalBoxParamsFacade
{

    public function __construct(
        private readonly MinimalBoxParamsCalculator $minimalBoxParamsCalculator,
        private readonly PackagingRepository $packagingRepository
    )
    {
    }

    public function getMinimalPackaging(
        IdentifiedBoxList $boxes
    ): Packaging
    {
        $availablePackagings = $this->packagingRepository->findAll();

        return $this->minimalBoxParamsCalculator->getMinimalPackaging(
            $availablePackagings,
            $boxes
        );
    }

}
