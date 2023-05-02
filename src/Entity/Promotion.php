<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $old_job = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $new_job = null;

    #[ORM\ManyToOne(inversedBy: 'promotion')]
    private ?Employees $employees = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOldJob(): ?string
    {
        return $this->old_job;
    }

    public function setOldJob(string $old_job): self
    {
        $this->old_job = $old_job;

        return $this;
    }

    public function getNewJob(): ?string
    {
        return $this->new_job;
    }

    public function setNewJob(string $new_job): self
    {
        $this->new_job = $new_job;

        return $this;
    }

    public function getEmployees(): ?Employees
    {
        return $this->employees;
    }

    public function setEmployees(?Employees $employees): self
    {
        $this->employees = $employees;

        return $this;
    }
}
