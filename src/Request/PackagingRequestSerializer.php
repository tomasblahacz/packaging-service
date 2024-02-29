<?php

declare(strict_types = 1);

namespace App\Request;

use JMS\Serializer\Serializer;

class PackagingRequestSerializer
{

    private Serializer $serializer;

    public function __construct(
        Serializer $serializer
    )
    {
        $this->serializer = $serializer;
    }

    public function deserialize(string $json): PackagingRequest
    {
        /** @var PackagingRequest $packagingRequest */
        $packagingRequest = $this->serializer->deserialize(
            $json,
            PackagingRequest::class,
            'json'
        );

        return $packagingRequest;
    }

}
