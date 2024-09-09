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
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Login::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $user = null;

    #[ORM\Column]
    private ?int $score = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUser(): ?Login
    {
        return $this->user;
    }

    public function setUser(Login $user): static
    {
        $this->user = $user;

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