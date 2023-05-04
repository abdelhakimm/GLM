<?php

namespace App\Entity;

use App\Repository\MemoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemoRepository::class)]
class Memo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $commercial_costs = null;

    #[ORM\Column]
    private ?int $employees_costs = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCommercialCosts(): ?int
    {
        return $this->commercial_costs;
    }

    public function setCommercialCosts(int $commercial_costs): self
    {
        $this->commercial_costs = $commercial_costs;

        return $this;
    }

    public function getEmployeesCosts(): ?int
    {
        return $this->employees_costs;
    }

    public function setEmployeesCosts(int $employees_costs): self
    {
        $this->employees_costs = $employees_costs;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
