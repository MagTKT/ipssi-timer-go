<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=UserTeam::class, mappedBy="idTeam")
     */
    private $userTeams;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="teams")
     */
    private $idStatus;

    /**
     * @ORM\OneToMany(targetEntity=Timer::class, mappedBy="idTeam")
     */
    private $timers;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date_creation;

    /**
     * @ORM\OneToMany(targetEntity=Project::class, mappedBy="Team")
     */
    private $projects;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TeamAdmin;

    public function __construct()
    {
        $this->userTeams = new ArrayCollection();
        $this->timers = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $userTeam->setIdTeam($this);
        }

        return $this;
    }

    public function removeUserTeam(UserTeam $userTeam): self
    {
        if ($this->userTeams->contains($userTeam)) {
            $this->userTeams->removeElement($userTeam);
            // set the owning side to null (unless already changed)
            if ($userTeam->getIdTeam() === $this) {
                $userTeam->setIdTeam(null);
            }
        }

        return $this;
    }

    public function getIdStatus(): ?status
    {
        return $this->idStatus;
    }

    public function setIdStatus(?status $idStatus): self
    {
        $this->idStatus = $idStatus;

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
            $timer->setIdTeam($this);
        }

        return $this;
    }

    public function removeTimer(Timer $timer): self
    {
        if ($this->timers->contains($timer)) {
            $this->timers->removeElement($timer);
            // set the owning side to null (unless already changed)
            if ($timer->getIdTeam() === $this) {
                $timer->setIdTeam(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->Date_creation;
    }

    public function setDateCreation(?\DateTimeInterface $Date_creation): self
    {
        $this->Date_creation = $Date_creation;
        
        return $this;
    }
  
    public function getTeamAdmin(): ?User
    {
        return $this->TeamAdmin;
    }

    public function setTeamAdmin(?User $TeamAdmin): self
    {
        $this->TeamAdmin = $TeamAdmin;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setTeam($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getTeam() === $this) {
                $project->setTeam(null);
            }
        }

        return $this;
    }
}
