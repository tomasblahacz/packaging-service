<?php

declare(strict_types = 1);

namespace App\Api\BinPacking\Response;

use JMS\Serializer\Annotation as Serializer;

class FindBoxSizeResponse
{

    /**
     * @Serializer\Type(FindBoxSizeResponseResponse::class)
     */
    private FindBoxSizeResponseResponse $response;

    public function getResponse(): FindBoxSizeResponseResponse
    {
        return $this->response;
    }

}
