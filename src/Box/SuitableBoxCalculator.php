<?php

declare(strict_types = 1);

namespace App\Box;

use App\Dto\Box;
use App\Entity\Packaging;
use App\Exception\NoPackagingAvailableException;
use App\List\PackagingList;

class SuitableBoxCalculator
{

    public function __construct(
        readonly private PackageBoxFitResolver $packageBoxFitResolver
    )
    {
    }

    public function getSmallestPackagingPossible(
        PackagingList $availablePackagings,
        Box $box
    ): Packaging
    {
        $availableBoxes = [];
        foreach ($availablePackagings->getPackagings() as $packaging) {
            if ($this->packageBoxFitResolver->doesBoxFit($packaging, $box)) {
                $availableBoxes[] = $packaging;
            }
        }

        if (count($availableBoxes) === 0) {
            throw new NoPackagingAvailableException();
        }

        usort($availableBoxes, function (Packaging $a, Packaging $b) {
            return $a->getVolume() <=> $b->getVolume();
        });

        return $availableBoxes[0];
    }

}
