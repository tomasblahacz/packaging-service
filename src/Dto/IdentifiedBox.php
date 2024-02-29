<?php

declare(strict_types = 1);

namespace App\Dto;

class IdentifiedBox extends Box
{

    public function __construct(
        private readonly int $id,
        float $width,
        float $height,
        float $length,
        float $weight
    )
    {
        parent::__construct($width, $height, $length, $weight);
    }

    public function getId(): int
    {
        return $this->id;
    }

}
