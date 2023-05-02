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

    #[ORM\Column(length: 50)]
    private ?string $lastname = null;

    #[ORM\Column(length: 50)]
    private ?string $firstname = null;

    #[ORM\Column]
    private ?int $phone_number = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $hiring_date = null;

    #[ORM\Column(length: 50)]
    private ?string $roles = null;

    #[ORM\Column(length: 50)]
    private ?string $job = null;

    #[ORM\Column(length: 255)]
    private ?string $profile_picture = null;
    
    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mutual $mutual = null;

    #[ORM\ManyToMany(targetEntity: Meetings::class, inversedBy: 'employees')]
    private Collection $meeting;

    #[ORM\OneToOne(inversedBy: 'employees', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contract $contract = null;

    #[ORM\ManyToMany(targetEntity: Holidays::class, inversedBy: 'employees')]
    private Collection $holidays;

    #[ORM\ManyToMany(targetEntity: OfficeEquipment::class, inversedBy: 'employees')]
    private Collection $office_equipment;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Report $report = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Salary $salary = null;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Payslip $payslip = null;

    #[ORM\OneToMany(mappedBy: 'employees', targetEntity: Bill::class)]
    private Collection $bill;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'employees')]
    private Collection $product;

    public function __construct()
    {
        $this->address = new ArrayCollection();
        $this->meeting = new ArrayCollection();
        $this->holidays = new ArrayCollection();
        $this->office_equipment = new ArrayCollection();
        $this->bill = new ArrayCollection();
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getRoles(): ?string
    {
        return $this->roles;
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

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
            $address->setEmployees($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->address->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getEmployees() === $this) {
                $address->setEmployees(null);
            }
        }

        return $this;
    }

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
}
