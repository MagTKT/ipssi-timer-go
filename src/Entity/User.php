<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=UserTeam::class, mappedBy="idUser")
     */
    private $userTeams;

    /**
     * @ORM\OneToMany(targetEntity=UserProject::class, mappedBy="idUser")
     */
    private $userProjects;
  
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="users")
     */
    private $Status;
  
    /**
     * @ORM\OneToMany(targetEntity=Timer::class, mappedBy="idUser")
     */
    private $timers;

    public function __construct()
    {
        $this->userTeams = new ArrayCollection();
        $this->userProjects = new ArrayCollection();
        $this->timers = new ArrayCollection();
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|UserTeam[]
     */
    public function getUserTeams(): Collection
    {
        return $this->userTeams;
    }

    public function addUserTeam(UserTeam $userTeam): self
    {
        if (!$this->userTeams->contains($userTeam)) {
            $this->userTeams[] = $userTeam;
            $userTeam->setIdUser($this);
        }

        return $this;
    }

    public function removeUserTeam(UserTeam $userTeam): self
    {
        if ($this->userTeams->contains($userTeam)) {
            $this->userTeams->removeElement($userTeam);
            // set the owning side to null (unless already changed)
            if ($userTeam->getIdUser() === $this) {
                $userTeam->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserProject[]
     */
    public function getUserProjects(): Collection
    {
        return $this->userProjects;
    }

    public function addUserProject(UserProject $userProject): self
    {
        if (!$this->userProjects->contains($userProject)) {
            $this->userProjects[] = $userProject;
            $userProject->setIdUser($this);
        }

        return $this;
    }

    public function removeUserProject(UserProject $userProject): self
    {
        if ($this->userProjects->contains($userProject)) {
            $this->userProjects->removeElement($userProject);
            // set the owning side to null (unless already changed)
            if ($userProject->getIdUser() === $this) {
                $userProject->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Timer[]
     */
    public function getTimers(): Collection
    {
        return $this->timers;
    }

    public function addTimer(Timer $timer): self
    {
        if (!$this->timers->contains($timer)) {
            $this->timers[] = $timer;
            $timer->setIdUser($this);
        }
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function removeTimer(Timer $timer): self
    {
        if ($this->timers->contains($timer)) {
            $this->timers->removeElement($timer);
            // set the owning side to null (unless already changed)
            if ($timer->getIdUser() === $this) {
                $timer->setIdUser(null);
            }
        }
    }
    
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->Status;
    }

    public function setStatus(?Status $Status): self
    {
        $this->Status = $Status;

        return $this;
    }
}
