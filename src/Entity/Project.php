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
     * @ORM\ManyToOne(targetEntity=status::class, inversedBy="projects")
     */
    private $idStatus;

    public function __construct()
    {
        $this->userProjects = new ArrayCollection();
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
}
