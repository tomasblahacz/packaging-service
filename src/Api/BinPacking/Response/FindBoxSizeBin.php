<?php

declare(strict_types = 1);

namespace App\Api\BinPacking\Response;

use JMS\Serializer\Annotation as Serializer;

class FindBoxSizeBin
{

    /**
     * @Serializer\Type(FindBoxSizeBinData::class)
     */
    private FindBoxSizeBinData $binData;

    /**
     * @var FindBoxSizeBinItem[]
     * @Serializer\Type("array<App\Api\BinPacking\Response\FindBoxSizeBinItem>")
     */
    private array $items;

    public function getBinData(): FindBoxSizeBinData
    {
        return $this->binData;
    }

    /**
     * @return FindBoxSizeBinItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

}
