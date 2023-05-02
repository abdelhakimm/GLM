<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_sale = null;

    #[ORM\Column]
    private ?float $price_product = null;

    #[ORM\Column(length: 50)]
    private ?string $name_product = null;

    #[ORM\Column(length: 50)]
    private ?string $category = null;

    #[ORM\ManyToMany(targetEntity: Employees::class, mappedBy: 'product')]
    private Collection $employees;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bill $bill = null;

    #[ORM\ManyToMany(targetEntity: StockCompanyCommercial::class, mappedBy: 'product')]
    private Collection $stockCompanyCommercials;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->stockCompanyCommercials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDateSale(): ?\DateTimeInterface
    {
        return $this->date_sale;
    }

    public function setDateSale(\DateTimeInterface $date_sale): self
    {
        $this->date_sale = $date_sale;

        return $this;
    }

    public function getPriceProduct(): ?float
    {
        return $this->price_product;
    }

    public function setPriceProduct(float $price_product): self
    {
        $this->price_product = $price_product;

        return $this;
    }

    public function getNameProduct(): ?string
    {
        return $this->name_product;
    }

    public function setNameProduct(string $name_product): self
    {
        $this->name_product = $name_product;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

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
            $employee->addProduct($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            $employee->removeProduct($this);
        }

        return $this;
    }

    public function getBill(): ?Bill
    {
        return $this->bill;
    }

    public function setBill(?Bill $bill): self
    {
        $this->bill = $bill;

        return $this;
    }

    /**
     * @return Collection<int, StockCompanyCommercial>
     */
    public function getStockCompanyCommercials(): Collection
    {
        return $this->stockCompanyCommercials;
    }

    public function addStockCompanyCommercial(StockCompanyCommercial $stockCompanyCommercial): self
    {
        if (!$this->stockCompanyCommercials->contains($stockCompanyCommercial)) {
            $this->stockCompanyCommercials->add($stockCompanyCommercial);
            $stockCompanyCommercial->addProduct($this);
        }

        return $this;
    }

    public function removeStockCompanyCommercial(StockCompanyCommercial $stockCompanyCommercial): self
    {
        if ($this->stockCompanyCommercials->removeElement($stockCompanyCommercial)) {
            $stockCompanyCommercial->removeProduct($this);
        }

        return $this;
    }
}
