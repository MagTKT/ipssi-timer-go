<?php

namespace App\Entity;

use App\Repository\UserProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserProjectRepository::class)
 */
class UserProject
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userProjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="userProjects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProject;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="userProjects")
     */
    private $idStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?user
    {
        return $this->idUser;
    }

    public function setIdUser(?user $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdProject(): ?project
    {
        return $this->idProject;
    }

    public function setIdProject(?project $idProject): self
    {
        $this->idProject = $idProject;

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
