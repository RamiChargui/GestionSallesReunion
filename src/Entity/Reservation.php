<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 *  @ApiResource()
 */

class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDeb;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;


    /**
     * @ORM\OneToOne(targetEntity=Salle::class, inversedBy="reservation", cascade={"persist", "remove"})
     */
    private $salle;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="reunions")
     */
    private $participiants;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservationsCreer")
     */
    private $respansable;


    


    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->participiants = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }


    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getParticipiants(): Collection
    {
        return $this->participiants;
    }

    public function addParticipiant(User $participiant): self
    {
        if (!$this->participiants->contains($participiant)) {
            $this->participiants[] = $participiant;
            $participiant->addReunion($this);
        }

        return $this;
    }

    public function removeParticipiant(User $participiant): self
    {
        if ($this->participiants->removeElement($participiant)) {
            $participiant->removeReunion($this);
        }

        return $this;
    }

    public function getRespansable(): ?User
    {
        return $this->respansable;
    }

    public function setRespansable(?User $respansable): self
    {
        $this->respansable = $respansable;

        return $this;
    }

   



}
