<?php

namespace App\Entity;

use App\Repository\OfficeEquipmentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfficeEquipmentRepository::class)]
class OfficeEquipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $type_material = null;

    #[ORM\Column(length: 100)]
    private ?string $brand_material = null;

    #[ORM\Column(length: 100)]
    private ?string $model = null;

    #[ORM\Column(length: 20)]
    private ?string $serial_number = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_purchase = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_end_guarantee = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeMaterial(): ?string
    {
        return $this->type_material;
    }

    public function setTypeMaterial(string $type_material): self
    {
        $this->type_material = $type_material;

        return $this;
    }

    public function getBrandMaterial(): ?string
    {
        return $this->brand_material;
    }

    public function setBrandMaterial(string $brand_material): self
    {
        $this->brand_material = $brand_material;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serial_number;
    }

    public function setSerialNumber(string $serial_number): self
    {
        $this->serial_number = $serial_number;

        return $this;
    }

    public function getDatePurchase(): ?\DateTimeInterface
    {
        return $this->date_purchase;
    }

    public function setDatePurchase(\DateTimeInterface $date_purchase): self
    {
        $this->date_purchase = $date_purchase;

        return $this;
    }

    public function getDateEndGuarantee(): ?\DateTimeInterface
    {
        return $this->date_end_guarantee;
    }

    public function setDateEndGuarantee(\DateTimeInterface $date_end_guarantee): self
    {
        $this->date_end_guarantee = $date_end_guarantee;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
