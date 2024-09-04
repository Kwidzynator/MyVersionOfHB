<?php

namespace App\Entity;

use App\Repository\WordsRememberingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordsRememberingRepository::class)]
class WordsRemembering
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $place = null;

    #[ORM\ManyToOne(targetEntity: Login::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?int $user_id = null;

    #[ORM\Column]
    private ?int $score = null;

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): static
    {
        $this->score = $score;

        return $this;
    }
}
