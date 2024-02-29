<?php

declare(strict_types = 1);

namespace App\Response;

use JMS\Serializer\Serializer;

class PackagingResponseSerializer
{

    public function __construct(
        private readonly Serializer $serializer
    )
    {
    }

    public function serialize(PackagingResponse $packagingResponse): string
    {
        return $this->serializer->serialize($packagingResponse, 'json');
    }

}
