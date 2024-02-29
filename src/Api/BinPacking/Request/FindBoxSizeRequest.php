<?php

declare(strict_types = 1);

namespace App\Api\BinPacking\Request;

class FindBoxSizeRequest
{

    /**
     * @var FindBoxSizeBin[]
     */
    private array $bins;

    /**
     * @var FindBoxSizeItem[]
     */
    private array $items;

    /**
     * @param FindBoxSizeBin[] $bins
     * @param FindBoxSizeItem[] $items
     */
    public function __construct(
        array $bins,
        array $items
    )
    {
        $this->bins = $bins;
        $this->items = $items;
    }

}
