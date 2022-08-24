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
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="reunions")
     */
    private $participiants;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservationsCreer")
     */
    private $respansable;

    /**
     * @ORM\Column(type="date")
     */
    private $jour;

    /**
     * @ORM\Column(type="time")
     */
    private $timeDeb;

    /**
     * @ORM\Column(type="time")
     */
    private $timeFin;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="reservations")
     */
    private $salle;


    


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

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
    }

    public function setJour(\DateTimeInterface $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getTimeDeb(): ?\DateTimeInterface
    {
        return $this->timeDeb;
    }

    public function setTimeDeb(\DateTimeInterface $timeDeb): self
    {
        $this->timeDeb = $timeDeb;

        return $this;
    }

    public function getTimeFin(): ?\DateTimeInterface
    {
        return $this->timeFin;
    }

    public function setTimeFin(\DateTimeInterface $timeFin): self
    {
        $this->timeFin = $timeFin;

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

   



}
