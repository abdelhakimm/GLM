<?php

namespace App\Entity;

use App\Repository\ContractRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractRepository::class)]
class Contract
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date_contract = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date_contract = null;

    #[ORM\Column(length: 100)]
    private ?string $trype_contract = null;

    #[ORM\Column]
    private ?int $hour_contract = null;

    #[ORM\OneToOne(mappedBy: 'contract', cascade: ['persist', 'remove'])]
    private ?Employees $employees = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDateContract(): ?\DateTimeInterface
    {
        return $this->start_date_contract;
    }

    public function setStartDateContract(\DateTimeInterface $start_date_contract): self
    {
        $this->start_date_contract = $start_date_contract;

        return $this;
    }

    public function getEndDateContract(): ?\DateTimeInterface
    {
        return $this->end_date_contract;
    }

    public function setEndDateContract(\DateTimeInterface $end_date_contract): self
    {
        $this->end_date_contract = $end_date_contract;

        return $this;
    }

    public function getTrypeContract(): ?string
    {
        return $this->trype_contract;
    }

    public function setTrypeContract(string $trype_contract): self
    {
        $this->trype_contract = $trype_contract;

        return $this;
    }

    public function getHourContract(): ?int
    {
        return $this->hour_contract;
    }

    public function setHourContract(int $hour_contract): self
    {
        $this->hour_contract = $hour_contract;

        return $this;
    }

    public function getEmployees(): ?Employees
    {
        return $this->employees;
    }

    public function setEmployees(Employees $employees): self
    {
        // set the owning side of the relation if necessary
        if ($employees->getContract() !== $this) {
            $employees->setContract($this);
        }

        $this->employees = $employees;

        return $this;
    }
}
