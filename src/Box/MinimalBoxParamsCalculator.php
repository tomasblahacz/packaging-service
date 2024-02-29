<?php

declare(strict_types = 1);

namespace App\Box;

use App\Dto\Box;
use App\Dto\BoxList;
use App\Entity\Packaging;
use App\List\PackagingList;

class MinimalBoxParamsCalculator
{

    public function __construct(
        private readonly SuitableBoxCalculator $suitableBoxCalculator
    )
    {
    }

    public function getMinimalPackaging(
        PackagingList $availablePackagings,
        BoxList $boxes
    ): Packaging
    {
        $height = 0;
        $weight = 0;
        $maxWidth = 0;
        $maxLength = 0;

        foreach ($boxes->getBoxes() as $box) {
            $weight += $box->getWeight();
            $height += $box->getHeight();
            $maxWidth = max($maxWidth, $box->getWidth());
            $maxLength = max($maxLength, $box->getLength());
        }

        $finalBox = new Box(
            $maxWidth,
            $height,
            $maxLength,
            $weight
        );

        return $this->suitableBoxCalculator->getSmallestPackagingPossible($availablePackagings, $finalBox);
    }

}
