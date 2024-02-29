<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\PackagingResolution;
use App\Repository\Exception\BoxSizeNotResolvedException;
use Doctrine\ORM\EntityManager;

class PackagingResolutionRepository
{

    public function __construct(
        private readonly EntityManager $entityManager
    )
    {
    }

    public function getByBoxListIdentifier(string $boxListIdentifier): PackagingResolution
    {
        $boxSizeResolution = $this->entityManager
            ->getRepository(PackagingResolution::class)
            ->findOneBy(['boxListIdentifier' => $boxListIdentifier]);

        if ($boxSizeResolution === null) {
            throw new BoxSizeNotResolvedException();
        }

        return $boxSizeResolution;
    }

    public function save(PackagingResolution $packagingResolution): void
    {
        $this->entityManager->persist($packagingResolution);
        $this->entityManager->flush();
    }

}
