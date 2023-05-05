<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $zipcode = null;

    #[ORM\Column(length: 50)]
    private ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: Employees::class)]
    private Collection $employees;

    #[ORM\OneToOne(mappedBy: 'address', cascade: ['persist', 'remove'])]
    private ?Applicant $applicant = null;

    #[ORM\ManyToMany(targetEntity: PurchaseRequest::class, mappedBy: 'address')]
    private Collection $purchaseRequests;

    #[ORM\ManyToMany(targetEntity: PointOfSale::class, mappedBy: 'address')]
    private Collection $pointOfSales;

    public function __construct()
    {
        $this->purchaseRequests = new ArrayCollection();
        $this->pointOfSales = new ArrayCollection();
        $this->employees = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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
            $employee->setAddress($this);
        }

        return $this;
    }

    public function removeEmployee(Employees $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getAddress() === $this) {
                $employee->setAddress(null);
            }
        }

        return $this;
    }

    public function getApplicant(): ?Applicant
    {
        return $this->applicant;
    }

    public function setApplicant(Applicant $applicant): self
    {
        // set the owning side of the relation if necessary
        if ($applicant->getAddress() !== $this) {
            $applicant->setAddress($this);
        }

        $this->applicant = $applicant;

        return $this;
    }

    /**
     * @return Collection<int, PurchaseRequest>
     */
    public function getPurchaseRequests(): Collection
    {
        return $this->purchaseRequests;
    }

    public function addPurchaseRequest(PurchaseRequest $purchaseRequest): self
    {
        if (!$this->purchaseRequests->contains($purchaseRequest)) {
            $this->purchaseRequests->add($purchaseRequest);
            $purchaseRequest->addAddress($this);
        }

        return $this;
    }

    public function removePurchaseRequest(PurchaseRequest $purchaseRequest): self
    {
        if ($this->purchaseRequests->removeElement($purchaseRequest)) {
            $purchaseRequest->removeAddress($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PointOfSale>
     */
    public function getPointOfSales(): Collection
    {
        return $this->pointOfSales;
    }

    public function addPointOfSale(PointOfSale $pointOfSale): self
    {
        if (!$this->pointOfSales->contains($pointOfSale)) {
            $this->pointOfSales->add($pointOfSale);
            $pointOfSale->addAddress($this);
        }

        return $this;
    }

    public function removePointOfSale(PointOfSale $pointOfSale): self
    {
        if ($this->pointOfSales->removeElement($pointOfSale)) {
            $pointOfSale->removeAddress($this);
        }

        return $this;
    }
}
