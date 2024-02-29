<?php

declare(strict_types = 1);

namespace App\Dto;

use App\Request\PackagingRequest;
use App\Request\PackagingRequestProduct;

class BoxListFactory
{

    public function createFromPackagingRequest(
        PackagingRequest $packagingRequest
    ): BoxList
    {
        $boxes = array_map(
            function (PackagingRequestProduct $product) {
                return new Box(
                    $product->getLength(),
                    $product->getWidth(),
                    $product->getHeight(),
                    $product->getWeight()
                );
            },
            $packagingRequest->getProducts(),
        );

        return new BoxList(...$boxes);
    }

}
