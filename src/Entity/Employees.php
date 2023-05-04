<?php

namespace App\Entity;

use App\Repository\EmployeesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeesRepository::class)]
class Employees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $phone_number = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $hiring_date = null;

    #[ORM\Column(length: 50)]
    private ?string $job = null;

    #[ORM\Column(length: 255)]
    private ?string $profile_picture = null;
    
    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable : true)]
    private ?Mutual $mutual = null;

    #[ORM\ManyToMany(targetEntity: Meetings::class, inversedBy: 'employees')]
    private Collection $meeting;

    #[ORM\OneToOne(inversedBy: 'employees', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable : true)]
    private ?Contract $contract = null;

    #[ORM\ManyToMany(targetEntity: Holidays::class, inversedBy: 'employees')]
    private Collection $holidays;

    #[ORM\ManyToMany(targetEntity: OfficeEquipment::class, inversedBy: 'employees')]
    private Collection $office_equipment;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable : true)]
    private ?Report $report = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable : true)]
    private ?Salary $salary = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable : true)]
    private ?Payslip $payslip = null;

    #[ORM\OneToMany(mappedBy: 'employees', targetEntity: Bill::class)]
    private Collection $bill;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'employees')]
    private Collection $product;

    #[ORM\ManyToMany(targetEntity: PointOfSale::class, inversedBy: 'employees')]
    private Collection $point_sale;

    #[ORM\OneToMany(mappedBy: 'employees', targetEntity: Promotion::class)]
    private Collection $promotion;

    #[ORM\ManyToMany(targetEntity: Memo::class, inversedBy: 'employees')]
    private Collection $memo;

    #[ORM\ManyToMany(targetEntity: PurchaseRequest::class, inversedBy: 'employees')]
    private Collection $purchase_request;

    #[ORM\OneToOne(targetEntity: "User",mappedBy: 'employee', cascade: ['persist', 'remove'])]
    
    private ?User $user = null;

    public function __construct()
    {
        $this->meeting = new ArrayCollection();
        $this->holidays = new ArrayCollection();
        $this->office_equipment = new ArrayCollection();
        $this->bill = new ArrayCollection();
        $this->product = new ArrayCollection();
        $this->point_sale = new ArrayCollection();
        $this->promotion = new ArrayCollection();
        $this->memo = new ArrayCollection();
        $this->purchase_request = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(int $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getHiringDate(): ?\DateTimeInterface
    {
        return $this->hiring_date;
    }

    public function setHiringDate(\DateTimeInterface $hiring_date): self
    {
        $this->hiring_date = $hiring_date;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(string $profile_picture): self
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    // public function addAddress(Address $address): self
    // {
    //     if (!$this->address->contains($address)) {
    //         $this->address->add($address);
    //         $address->setEmployees($this);
    //     }

    //     return $this;
    // }

    public function setAddress(Address $address): self{

        $this->address = $address;
        return  $this;
    }

    // public function removeAddress(Address $address): self
    // {
    //     if ($this->address->removeElement($address)) {
    //         // set the owning side to null (unless already changed)
    //         if ($address->getEmployees() === $this) {
    //             $address->setEmployees(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getMutual(): ?Mutual
    {
        return $this->mutual;
    }

    public function setMutual(?Mutual $mutual): self
    {
        $this->mutual = $mutual;

        return $this;
    }

    /**
     * @return Collection<int, Meetings>
     */
    public function getMeeting(): Collection
    {
        return $this->meeting;
    }

    public function addMeeting(Meetings $meeting): self
    {
        if (!$this->meeting->contains($meeting)) {
            $this->meeting->add($meeting);
        }

        return $this;
    }

    public function removeMeeting(Meetings $meeting): self
    {
        $this->meeting->removeElement($meeting);

        return $this;
    }

    public function getContract(): ?Contract
    {
        return $this->contract;
    }

    public function setContract(Contract $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * @return Collection<int, Holidays>
     */
    public function getHolidays(): Collection
    {
        return $this->holidays;
    }

    public function addHoliday(Holidays $holiday): self
    {
        if (!$this->holidays->contains($holiday)) {
            $this->holidays->add($holiday);
        }

        return $this;
    }

    public function removeHoliday(Holidays $holiday): self
    {
        $this->holidays->removeElement($holiday);

        return $this;
    }

    /**
     * @return Collection<int, OfficeEquipment>
     */
    public function getOfficeEquipment(): Collection
    {
        return $this->office_equipment;
    }

    public function addOfficeEquipment(OfficeEquipment $officeEquipment): self
    {
        if (!$this->office_equipment->contains($officeEquipment)) {
            $this->office_equipment->add($officeEquipment);
        }

        return $this;
    }

    public function removeOfficeEquipment(OfficeEquipment $officeEquipment): self
    {
        $this->office_equipment->removeElement($officeEquipment);

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

    public function getSalary(): ?Salary
    {
        return $this->salary;
    }

    public function setSalary(?Salary $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getPayslip(): ?Payslip
    {
        return $this->payslip;
    }

    public function setPayslip(?Payslip $payslip): self
    {
        $this->payslip = $payslip;

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
            $bill->setEmployees($this);
        }

        return $this;
    }

    public function removeBill(Bill $bill): self
    {
        if ($this->bill->removeElement($bill)) {
            // set the owning side to null (unless already changed)
            if ($bill->getEmployees() === $this) {
                $bill->setEmployees(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->product->removeElement($product);

        return $this;
    }

    /**
     * @return Collection<int, PointOfSale>
     */
    public function getPointSale(): Collection
    {
        return $this->point_sale;
    }

    public function addPointSale(PointOfSale $pointSale): self
    {
        if (!$this->point_sale->contains($pointSale)) {
            $this->point_sale->add($pointSale);
        }

        return $this;
    }

    public function removePointSale(PointOfSale $pointSale): self
    {
        $this->point_sale->removeElement($pointSale);

        return $this;
    }

    /**
     * @return Collection<int, Promotion>
     */
    public function getPromotion(): Collection
    {
        return $this->promotion;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotion->contains($promotion)) {
            $this->promotion->add($promotion);
            $promotion->setEmployees($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotion->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getEmployees() === $this) {
                $promotion->setEmployees(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Memo>
     */
    public function getMemo(): Collection
    {
        return $this->memo;
    }

    public function addMemo(Memo $memo): self
    {
        if (!$this->memo->contains($memo)) {
            $this->memo->add($memo);
        }

        return $this;
    }

    public function removeMemo(Memo $memo): self
    {
        $this->memo->removeElement($memo);

        return $this;
    }

    /**
     * @return Collection<int, PurchaseRequest>
     */
    public function getPurchaseRequest(): Collection
    {
        return $this->purchase_request;
    }

    public function addPurchaseRequest(PurchaseRequest $purchaseRequest): self
    {
        if (!$this->purchase_request->contains($purchaseRequest)) {
            $this->purchase_request->add($purchaseRequest);
        }

        return $this;
    }

    public function removePurchaseRequest(PurchaseRequest $purchaseRequest): self
    {
        $this->purchase_request->removeElement($purchaseRequest);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setEmployee(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getEmployee() !== $this) {
            $user->setEmployee($this);
        }

        $this->user = $user;

        return $this;
    }
}
