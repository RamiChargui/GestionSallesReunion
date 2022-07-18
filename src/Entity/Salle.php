<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SalleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SalleRepository::class)
 *  @ApiResource()
 */

class Salle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 30
     * )
     */
    private $capacite;

    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, mappedBy="salle", cascade={"persist", "remove"})
     */
    private $reservation;

    /**
     * @ORM\OneToOne(targetEntity=Reclamation::class, mappedBy="salle", cascade={"persist", "remove"})
     */
    private $reclamation;

    /**
     * @ORM\Column(type="integer")
     */
    private $etat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;
        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): self
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        // unset the owning side of the relation if necessary
        if ($reservation === null && $this->reservation !== null) {
            $this->reservation->setSalle(null);
        }

        // set the owning side of the relation if necessary
        if ($reservation !== null && $reservation->getSalle() !== $this) {
            $reservation->setSalle($this);
        }

        $this->reservation = $reservation;

        return $this;
    }

    public function getReclamation(): ?Reclamation
    {
        return $this->reclamation;
    }

    public function setReclamation(?Reclamation $reclamation): self
    {
        // unset the owning side of the relation if necessary
        if ($reclamation === null && $this->reclamation !== null) {
            $this->reclamation->setSalle(null);
        }

        // set the owning side of the relation if necessary
        if ($reclamation !== null && $reclamation->getSalle() !== $this) {
            $reclamation->setSalle($this);
        }

        $this->reclamation = $reclamation;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
