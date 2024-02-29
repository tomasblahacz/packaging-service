<?php

declare(strict_types = 1);

namespace App\Api\BinPacking\Request;

use JMS\Serializer\Annotation as Serializer;

class FindBoxSizeBin
{

    /**
     * @Serializer\SerializedName("id")
     */
    private int $id;

    /**
     * @Serializer\SerializedName("w")
     */
    private float $width;

    /**
     * @Serializer\SerializedName("h")
     */
    private float $height;

    /**
     * @Serializer\SerializedName("d")
     */
    private float $length;

    public function __construct(
        int $id,
        float $width,
        float $height,
        float $length,
    )
    {
        $this->id = $id;
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
    }

}
