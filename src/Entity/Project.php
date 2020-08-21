<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
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
    private $name_project;

    /**
     * @ORM\OneToMany(targetEntity=UserProject::class, mappedBy="idProject")
     */
    private $userProjects;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="projects")
     */
    private $idStatus;

    /**
     * @ORM\OneToMany(targetEntity=Timer::class, mappedBy="idProject")
     */
    private $timers;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date_creation;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="projects")
     */
    private $Team;

    public function __construct()
    {
        $this->userProjects = new ArrayCollection();
        $this->timers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProject(): ?string
    {
        return $this->name_project;
    }

    public function setNameProject(string $name_project): self
    {
        $this->name_project = $name_project;

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
            $userProject->setIdProject($this);
        }

        return $this;
    }

    public function removeUserProject(UserProject $userProject): self
    {
        if ($this->userProjects->contains($userProject)) {
            $this->userProjects->removeElement($userProject);
            // set the owning side to null (unless already changed)
            if ($userProject->getIdProject() === $this) {
                $userProject->setIdProject(null);
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
            $timer->setIdProject($this);
        }

        return $this;
    }

    public function removeTimer(Timer $timer): self
    {
        if ($this->timers->contains($timer)) {
            $this->timers->removeElement($timer);
            // set the owning side to null (unless already changed)
            if ($timer->getIdProject() === $this) {
                $timer->setIdProject(null);
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

    public function getTeam(): ?Team
    {
        return $this->Team;
    }

    public function setTeam(?Team $Team): self
    {
        $this->Team = $Team;

        return $this;
    }
}
