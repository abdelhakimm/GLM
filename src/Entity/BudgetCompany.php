<?php

namespace App\Entity;

use App\Repository\BudgetCompanyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BudgetCompanyRepository::class)]
class BudgetCompany
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $years = null;

    #[ORM\Column]
    private ?float $sum = null;

    #[ORM\Column(length: 100)]
    private ?string $service = null;

    #[ORM\ManyToOne(inversedBy: 'budgetCompanies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Report $report = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYears(): ?int
    {
        return $this->years;
    }

    public function setYears(int $years): self
    {
        $this->years = $years;

        return $this;
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

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getReport(): ?Report
    {
        return $this->report;
    }

    public function setReport(?Report $report): self
    {
        $this->report = $report;

        return $this;
    }
}
