<?php

namespace App\Entity;

use App\Repository\UserTeamRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserTeamRepository::class)
 */
class UserTeam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userTeams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="userTeams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTeam;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="userTeams")
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

    public function getIdTeam(): ?team
    {
        return $this->idTeam;
    }

    public function setIdTeam(?team $idTeam): self
    {
        $this->idTeam = $idTeam;

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
