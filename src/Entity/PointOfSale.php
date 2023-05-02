<?php

namespace App\Entity;

use App\Repository\PointOfSaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointOfSaleRepository::class)]
class PointOfSale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name_varchar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameVarchar(): ?string
    {
        return $this->name_varchar;
    }

    public function setNameVarchar(string $name_varchar): self
    {
        $this->name_varchar = $name_varchar;

        return $this;
    }
}
