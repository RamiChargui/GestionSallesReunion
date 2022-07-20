<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MaterielRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielRepository::class)
 *  @ApiResource()
 */

class Materiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="materiels")
     */
    private $salle;

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
        return (string) $this->libelle;
    }
}
