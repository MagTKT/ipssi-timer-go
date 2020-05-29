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
     * @ORM\Column(type="datetime")
     */
    private $TimerStart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $TimerStop;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, nullable=true)
     */
    private $TimerTotalTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TimerComment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimerStart(): ?\DateTimeInterface
    {
        return $this->TimerStart;
    }

    public function setTimerStart(\DateTimeInterface $TimerStart): self
    {
        $this->TimerStart = $TimerStart;

        return $this;
    }

    public function getTimerStop(): ?\DateTimeInterface
    {
        return $this->TimerStop;
    }

    public function setTimerStop(\DateTimeInterface $TimerStop): self
    {
        $this->TimerStop = $TimerStop;

        return $this;
    }

    public function getTimerTotalTime(): ?string
    {
        return $this->TimerTotalTime;
    }

    public function setTimerTotalTime(?string $TimerTotalTime): self
    {
        $this->TimerTotalTime = $TimerTotalTime;

        return $this;
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
