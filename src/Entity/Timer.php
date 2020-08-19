<?php

namespace App\Entity;

use App\Repository\TimerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TimerRepository::class)
 */
class Timer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="timers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="timers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTeam;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="timers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProject;
    /**
     * @ORM\Column(type="datetime")
     */

    private $DateTime_Debut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateTime_Fin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Cumul_s;
  
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TimerComment;
  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdTeam(): ?Team
    {
        return $this->idTeam;
    }

    public function setIdTeam(?Team $idTeam): self
    {
        $this->idTeam = $idTeam;

        return $this;
    }

    public function getIdProject(): ?Project
    {
        return $this->idProject;
    }

    public function setIdProject(?Project $idProject): self
    {
        $this->idProject = $idProject;

        return $this;
    }

    public function getDateTimeDebut(): ?\DateTimeInterface
    {
        return $this->DateTime_Debut;
    }

    public function setDateTimeDebut(\DateTimeInterface $DateTime_Debut): self
    {
        $this->DateTime_Debut = $DateTime_Debut;

        return $this;
    }

    public function getDateTimeFin(): ?\DateTimeInterface
    {
        return $this->DateTime_Fin;
    }

    public function setDateTimeFin(\DateTimeInterface $DateTime_Fin): self
    {
        $this->DateTime_Fin = $DateTime_Fin;

        return $this;
    }

    public function getCumulS(): ?int
    {
        return $this->Cumul_s;
    }

    public function setCumulS(?int $Cumul_s): self
    {
        $this->Cumul_s = $Cumul_s;
    }
    
    public function getTimerComment(): ?string
    {
        return $this->TimerComment;
    }

    public function setTimerComment(?string $TimerComment): self
    {
        $this->TimerComment = $TimerComment;

        return $this;
    }
}
