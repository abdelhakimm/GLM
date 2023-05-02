<?php

namespace App\Entity;

use App\Repository\CARepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CARepository::class)]
class CA
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
    private ?float $total_sum = null;

    #[ORM\Column]
    private ?float $net_sales = null;

    #[ORM\Column]
    private ?float $gross_sales = null;

    #[ORM\Column]
    private ?float $projected_turnover = null;

    #[ORM\OneToOne(inversedBy: 'ca', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Report $report = null;

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

    public function getTotalSum(): ?float
    {
        return $this->total_sum;
    }

    public function setTotalSum(float $total_sum): self
    {
        $this->total_sum = $total_sum;

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

    public function getGrossSales(): ?float
    {
        return $this->gross_sales;
    }

    public function setGrossSales(float $gross_sales): self
    {
        $this->gross_sales = $gross_sales;

        return $this;
    }

    public function getProjectedTurnover(): ?float
    {
        return $this->projected_turnover;
    }

    public function setProjectedTurnover(float $projected_turnover): self
    {
        $this->projected_turnover = $projected_turnover;

        return $this;
    }

    public function getReport(): ?Report
    {
        return $this->report;
    }

    public function setReport(Report $report): self
    {
        $this->report = $report;

        return $this;
    }
}
