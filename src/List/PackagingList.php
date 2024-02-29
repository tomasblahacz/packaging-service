<?php

declare(strict_types = 1);

namespace App\List;

use App\Entity\Packaging;

class PackagingList
{

    private array $packagings;

    public function __construct(
        Packaging ...$packagings
    )
    {
        $this->packagings = $packagings;
    }

    /**
     * @return Packaging[]
     */
    public function getPackagings(): array
    {
        return $this->packagings;
    }

}
