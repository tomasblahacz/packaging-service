<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Packaging;
use App\List\PackagingList;
use App\Repository\Exception\PackagingNotFoundException;
use Doctrine\ORM\EntityManager;

class PackagingRepository
{

    private EntityManager $entityManager;

    public function __construct(
        EntityManager $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function findAll(): PackagingList
    {
        return new PackagingList(
            ...$this->entityManager->getRepository(Packaging::class)->findAll()
        );
    }

    public function getById(string $id): Packaging
    {
        $packaging = $this->entityManager->getRepository(Packaging::class)->find($id);

        if ($packaging === null) {
            throw new PackagingNotFoundException();
        }

        return $packaging;
    }

}
