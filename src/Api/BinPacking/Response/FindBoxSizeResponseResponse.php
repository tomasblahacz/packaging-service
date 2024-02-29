<?php

declare(strict_types = 1);

namespace App\Api\BinPacking\Response;

use JMS\Serializer\Annotation as Serializer;

class FindBoxSizeResponseResponse
{

    public const STATUS_OK = 1;
    public const STATUS_NOT_OK = 0;

    private string $id;

    /**
     * @Serializer\Type("int")
     */
    private int $status;

    /**
     * @var FindBoxSizeBin[]
     * @Serializer\Type("array<App\Api\BinPacking\Response\FindBoxSizeBin>")
     */
    private array $binsPacked;

    /**
     * @return FindBoxSizeBin[]
     * @Serializer\Type("array<App\Api\BinPacking\Response\FindBoxSizeBin>")
     */
    public function getBinsPacked(): array
    {
        return $this->binsPacked;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

}
