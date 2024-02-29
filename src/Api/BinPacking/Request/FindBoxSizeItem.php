<?php

declare(strict_types = 1);

namespace App\Api\BinPacking\Request;

use JMS\Serializer\Annotation as Serializer;

class FindBoxSizeItem
{

    private const ALL_ITEMS_CAN_BE_VERTICALLY_ROTATED = 1;

    /**
     * @Serializer\SerializedName("id")
     */
    private string $id;

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

    /**
     * @Serializer\SerializedName("q")
     */
    private int $quantity;

    /**
     * @Serializer\SerializedName("vr")
     */
    private int $verticalRotation;

    public function __construct(string $id, float $width, float $height, float $length, int $quantity)
    {
        $this->id = $id;
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
        $this->quantity = $quantity;
        $this->verticalRotation = self::ALL_ITEMS_CAN_BE_VERTICALLY_ROTATED;
    }

}
