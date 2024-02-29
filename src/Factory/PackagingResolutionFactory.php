<?php

declare(strict_types = 1);

namespace App\Factory;

use App\Entity\Packaging;
use App\Entity\PackagingResolution;

class PackagingResolutionFactory
{

    public function create(
        string $boxListIdentifier,
        Packaging $packaging
    ): PackagingResolution
    {
        return new PackagingResolution(
            $boxListIdentifier,
            $packaging,
        );
    }

}
