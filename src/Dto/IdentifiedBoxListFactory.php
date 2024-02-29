<?php

declare(strict_types = 1);

namespace App\Dto;

use App\Request\PackagingRequest;
use App\Request\PackagingRequestProduct;

class IdentifiedBoxListFactory
{

    public function createFromPackagingRequest(
        PackagingRequest $packagingRequest
    ): IdentifiedBoxList
    {
        $boxes = array_map(
            function (PackagingRequestProduct $product): IdentifiedBox {
                return new IdentifiedBox(
                    $product->getId(),
                    $product->getLength(),
                    $product->getWidth(),
                    $product->getHeight(),
                    $product->getWeight()
                );
            },
            $packagingRequest->getProducts(),
        );

        return new IdentifiedBoxList(...$boxes);
    }

}
