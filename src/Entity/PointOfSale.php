<?php

namespace App\Entity;

use App\Repository\PointOfSaleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointOfSaleRepository::class)]
class PointOfSale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name_varchar = null;

    #[ORM\ManyToMany(targetEntity: Employees::class, mappedBy: 'point_sale')]
    private Collection $employees;

    #[ORM\ManyToMany(targetEntity: Address::class, inversedBy: 'pointOfSales')]
    private Collection $address;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->address = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameVarchar(): ?string
    {
        return $this->name_varchar;
    }

    public function setNameVarchar(string $name_varchar): self
    {
        $this->name_varchar = $name_varchar;

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
            $employee->addPointSale($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            $employee->removePointSale($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Address>
     */
    public function getAddress(): Collection
    {
        return $this->address;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->address->contains($address)) {
            $this->address->add($address);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        $this->address->removeElement($address);

        return $this;
    }
}
