<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Department;
use App\Entity\Reservation;
use App\Entity\Notification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ApiResource()
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ["ROLE_USER"];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="employees")
     */
    private $department;

    /**
     * @ORM\ManyToMany(targetEntity=Reservation::class, inversedBy="participiants")
     */
    private $reunions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="respansable")
     */
    private $reservationsCreer;

    private $plainPassword;

    /**
     * @ORM\ManyToMany(targetEntity=Notification::class, mappedBy="usersConcernes")
     */
    private $notifications;


    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $email): self
    {
        $this->plainPassword = $email;

        return $this;
    }

    
    
    public function __construct()
    {
        $this->reunions = new ArrayCollection();
        $this->reservationsCreer = new ArrayCollection();
        $this->notifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

   

    public function __toString()
    {
        return (string) $this->nom;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReunions(): Collection
    {
        return $this->reunions;
    }

    public function addReunion(Reservation $reunion): self
    {
        if (!$this->reunions->contains($reunion)) {
            $this->reunions[] = $reunion;
        }

        return $this;
    }

    public function removeReunion(Reservation $reunion): self
    {
        $this->reunions->removeElement($reunion);

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservationsCreer(): Collection
    {
        return $this->reservationsCreer;
    }

    public function addReservationsCreer(Reservation $reservationsCreer): self
    {
        if (!$this->reservationsCreer->contains($reservationsCreer)) {
            $this->reservationsCreer[] = $reservationsCreer;
            $reservationsCreer->setRespansable($this);
        }

        return $this;
    }

    public function removeReservationsCreer(Reservation $reservationsCreer): self
    {
        if ($this->reservationsCreer->removeElement($reservationsCreer)) {
            // set the owning side to null (unless already changed)
            if ($reservationsCreer->getRespansable() === $this) {
                $reservationsCreer->setRespansable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->addUsersConcerne($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            $notification->removeUsersConcerne($this);
        }

        return $this;
    }
   
}
