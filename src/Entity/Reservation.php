<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $reservationDate = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Utilisateur $ManyToOne = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Ordinateur $Ordinateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservationDate(): ?\DateTimeInterface
    {
        return $this->reservationDate;
    }

    public function setReservationDate(\DateTimeInterface $reservationDate): static
    {
        $this->reservationDate = $reservationDate;

        return $this;
    }

    public function getManyToOne(): ?Utilisateur
    {
        return $this->ManyToOne;
    }

    public function setManyToOne(?Utilisateur $ManyToOne): static
    {
        $this->ManyToOne = $ManyToOne;

        return $this;
    }

    public function getOrdinateur(): ?Ordinateur
    {
        return $this->Ordinateur;
    }

    public function setOrdinateur(?Ordinateur $Ordinateur): static
    {
        $this->Ordinateur = $Ordinateur;

        return $this;
    }
}
