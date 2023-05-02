<?php

namespace App\Entity;

use App\Repository\SalaryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaryRepository::class)]
class Salary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $sum = null;

    #[ORM\Column(length: 50)]
    private ?string $overtime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSum(): ?float
    {
        return $this->sum;
    }

    public function setSum(float $sum): self
    {
        $this->sum = $sum;

        return $this;
    }

    public function getOvertime(): ?string
    {
        return $this->overtime;
    }

    public function setOvertime(string $overtime): self
    {
        $this->overtime = $overtime;

        return $this;
    }
}
