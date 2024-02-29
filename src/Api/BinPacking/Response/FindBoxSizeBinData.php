<?php

declare(strict_types = 1);

namespace App\Api\BinPacking\Response;

use JMS\Serializer\Annotation as Serializer;

class FindBoxSizeBinData
{

    /**
     * @Serializer\Type("string")
     */
    private string $id;

    public function getId(): string
    {
        return $this->id;
    }

}
