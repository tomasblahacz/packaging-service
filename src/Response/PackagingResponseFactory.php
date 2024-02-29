<?php

declare(strict_types = 1);

namespace App\Response;

use App\Entity\Packaging;

class PackagingResponseFactory
{

    public function createResponse(Packaging $packaging): PackagingResponse
    {
        return new PackagingResponse(
            $packaging->getId(),
            $packaging->getWidth(),
            $packaging->getHeight(),
            $packaging->getLength(),
            $packaging->getMaxWeight()
        );
    }

}
