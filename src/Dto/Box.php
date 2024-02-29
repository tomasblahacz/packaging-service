<?php

declare(strict_types = 1);

namespace App\Dto;

class Box
{

    public function __construct(
        private readonly float $width,
        private readonly float $height,
        private readonly float $length,
        private readonly float $weight
    )
    {
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getLargestSideSurface(): float
    {
        return max(
            $this->width * $this->height,
            $this->width * $this->length,
            $this->height * $this->length
        );
    }

    public function getVolume(): float
    {
        return $this->width * $this->height * $this->length;
    }

    /**
     * @return float[]
     */
    public function getSideLengthsAscending(): array
    {
        $sides = [
            $this->width,
            $this->height,
            $this->length,
        ];

        sort($sides);

        return $sides;
    }

}
