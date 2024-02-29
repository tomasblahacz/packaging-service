<?php

declare(strict_types = 1);

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class PackagingRequestProduct
{

    /**
     * @Assert\NotBlank()
     */
    private int $id;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     */
    private float $width;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     */
    private float $height;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     */
    private float $length;

    /**
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     */
    private float $weight;

    public function getId(): int
    {
        return $this->id;
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

}
