<?php

namespace App\Entity;

use App\Repository\PurchaseRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseRequestRepository::class)]
class PurchaseRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_request = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price_request = null;

    #[ORM\ManyToMany(targetEntity: Employees::class, mappedBy: 'purchase_request')]
    private Collection $employees;

    #[ORM\ManyToMany(targetEntity: Address::class, inversedBy: 'purchaseRequests')]
    private Collection $address;

    #[ORM\ManyToMany(targetEntity: Bill::class, inversedBy: 'purchaseRequests')]
    private Collection $bill;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->address = new ArrayCollection();
        $this->bill = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRequest(): ?\DateTimeInterface
    {
        return $this->date_request;
    }

    public function setDateRequest(\DateTimeInterface $date_request): self
    {
        $this->date_request = $date_request;

        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPriceRequest(): ?float
    {
        return $this->price_request;
    }

    public function setPriceRequest(float $price_request): self
    {
        $this->price_request = $price_request;

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
            $employee->addPurchaseRequest($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            $employee->removePurchaseRequest($this);
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

    /**
     * @return Collection<int, Bill>
     */
    public function getBill(): Collection
    {
        return $this->bill;
    }

    public function addBill(Bill $bill): self
    {
        if (!$this->bill->contains($bill)) {
            $this->bill->add($bill);
        }

        return $this;
    }

    public function removeBill(Bill $bill): self
    {
        $this->bill->removeElement($bill);

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
