<?php

namespace App\Entity;

use App\Repository\PayslipRepository;
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
}
