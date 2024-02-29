<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PackagingResolution
{

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, unique: true)]
    private string $boxListIdentifier;

    #[ORM\ManyToOne(targetEntity: Packaging::class)]
    private Packaging $packaging;

    public function __construct(string $boxListIdentifier, Packaging $packaging)
    {
        $this->boxListIdentifier = $boxListIdentifier;
        $this->packaging = $packaging;
    }

    public function getPackaging(): Packaging
    {
        return $this->packaging;
    }

}
