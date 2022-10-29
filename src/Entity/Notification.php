<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NotificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=NotificationRepository::class)
 */
class Notification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="notifications")
     */
    private $usersConcernes;

    public function __construct()
    {
        $this->usersConcernes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersConcernes(): Collection
    {
        return $this->usersConcernes;
    }

    public function addUsersConcerne(User $usersConcerne): self
    {
        if (!$this->usersConcernes->contains($usersConcerne)) {
            $this->usersConcernes[] = $usersConcerne;
        }

        return $this;
    }

    public function removeUsersConcerne(User $usersConcerne): self
    {
        $this->usersConcernes->removeElement($usersConcerne);

        return $this;
    }

}
