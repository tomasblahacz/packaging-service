<?php

declare(strict_types = 1);

namespace App\Response;

use JMS\Serializer\Annotation as Serializer;

class PackagingResponse
{

    /**
     * @Serializer\Type("int")
     */
    private int $id;

    /**
     * @Serializer\Type("float")
     */
    private float $width;

    /**
     * @Serializer\Type("float")
     */
    private float $height;

    /**
     * @Serializer\Type("float")
     */
    private float $length;

    /**
     * @Serializer\Type("float")
     */
    private float $maxWeight;

    /**
     * @param int $id
     * @param float $width
     * @param float $height
     * @param float $length
     * @param float $maxWeight
     */
    public function __construct(int $id, float $width, float $height, float $length, float $maxWeight)
    {
        $this->id = $id;
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
        $this->maxWeight = $maxWeight;
    }

}
