<?php

namespace App\Entity;

use App\Repository\JobOfferRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobOfferRepository::class)]
class JobOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title_job = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $publication_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $deadline_candidacy = null;

    #[ORM\Column(length: 100)]
    private ?string $service = null;

    #[ORM\Column]
    private ?int $number_positions_available = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleJob(): ?string
    {
        return $this->title_job;
    }

    public function setTitleJob(string $title_job): self
    {
        $this->title_job = $title_job;

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

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(\DateTimeInterface $publication_date): self
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    public function getDeadlineCandidacy(): ?\DateTimeInterface
    {
        return $this->deadline_candidacy;
    }

    public function setDeadlineCandidacy(\DateTimeInterface $deadline_candidacy): self
    {
        $this->deadline_candidacy = $deadline_candidacy;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getNumberPositionsAvailable(): ?int
    {
        return $this->number_positions_available;
    }

    public function setNumberPositionsAvailable(int $number_positions_available): self
    {
        $this->number_positions_available = $number_positions_available;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
