<?php

namespace App\Entity;

use App\Repository\MutualRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MutualRepository::class)]
class Mutual
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name_mutual = null;

    #[ORM\Column(length: 50)]
    private ?string $percentage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMutual(): ?string
    {
        return $this->name_mutual;
    }

    public function setNameMutual(string $name_mutual): self
    {
        $this->name_mutual = $name_mutual;

        return $this;
    }

    public function getPercentage(): ?string
    {
        return $this->percentage;
    }

    public function setPercentage(string $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }
}
