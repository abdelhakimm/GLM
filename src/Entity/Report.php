<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportRepository::class)]
class Report
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(length: 255)]
    private ?string $pictures = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'report', targetEntity: Employees::class)]
    private Collection $employees;

    #[ORM\OneToMany(mappedBy: 'report', targetEntity: BudgetCompany::class)]
    private Collection $budgetCompanies;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->budgetCompanies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPictures(): ?string
    {
        return $this->pictures;
    }

    public function setPictures(string $pictures): self
    {
        $this->pictures = $pictures;

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

    /**
     * @return Collection<int, Employees>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employees $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->setReport($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getReport() === $this) {
                $employee->setReport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BudgetCompany>
     */
    public function getBudgetCompanies(): Collection
    {
        return $this->budgetCompanies;
    }

    public function addBudgetCompany(BudgetCompany $budgetCompany): self
    {
        if (!$this->budgetCompanies->contains($budgetCompany)) {
            $this->budgetCompanies->add($budgetCompany);
            $budgetCompany->setReport($this);
        }

        return $this;
    }

    public function removeBudgetCompany(BudgetCompany $budgetCompany): self
    {
        if ($this->budgetCompanies->removeElement($budgetCompany)) {
            // set the owning side to null (unless already changed)
            if ($budgetCompany->getReport() === $this) {
                $budgetCompany->setReport(null);
            }
        }

        return $this;
    }
}
