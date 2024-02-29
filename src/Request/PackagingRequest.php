<?php

declare(strict_types = 1);

namespace App\Request;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class PackagingRequest
{

    /**
     * @var PackagingRequestProduct[]
     * @Assert\Count(min=10)
     * @Serializer\Type("array<App\Request\PackagingRequestProduct>")
     */
    private array $products;

    /**
     * @return PackagingRequestProduct[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

}
