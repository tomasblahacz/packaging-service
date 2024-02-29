<?php

declare(strict_types = 1);

namespace App\Box;

use App\Dto\Box;
use App\Entity\Packaging;

class PackageBoxFitResolver
{

    public function doesBoxFit(
        Packaging $packaging,
        Box $box
    ): bool
    {
        if ($box->getWeight() >= $packaging->getMaxWeight()) {
            return false;
        }

        $packagingDimensions = [
            $packaging->getHeight(),
            $packaging->getWidth(),
            $packaging->getLength(),
        ];
        sort($packagingDimensions);

        $boxDimensions = [
            $box->getHeight(),
            $box->getWidth(),
            $box->getLength(),
        ];
        sort($boxDimensions);

        return $packagingDimensions[0] >= $boxDimensions[0]
            && $packagingDimensions[1] >= $boxDimensions[1]
            && $packagingDimensions[2] >= $boxDimensions[2];
    }

}
