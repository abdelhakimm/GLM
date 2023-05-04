<?php

namespace App\Entity;

use App\Repository\PayslipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PayslipRepository::class)]
class Payslip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $month = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?float $gross_sales = null;

    #[ORM\Column]
    private ?float $net_sales = null;

    #[ORM\OneToMany(mappedBy: 'payslip', targetEntity: Employees::class)]
    private Collection $employees;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(int $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getGrossSales(): ?float
    {
        return $this->gross_sales;
    }

    public function setGrossSales(float $gross_sales): self
    {
        $this->gross_sales = $gross_sales;

        return $this;
    }

    public function getNetSales(): ?float
    {
        return $this->net_sales;
    }

    public function setNetSales(float $net_sales): self
    {
        $this->net_sales = $net_sales;

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
            $employee->setPayslip($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getPayslip() === $this) {
                $employee->setPayslip(null);
            }
        }

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
