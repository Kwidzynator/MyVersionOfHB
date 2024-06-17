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
    private ?int $user_id = null;

    #[ORM\Column]
    private ?int $moves = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

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

    public function getMoves(): ?int
    {
        return $this->moves;
    }

    public function setMoves(int $moves): static
    {
        $this->moves = $moves;

        return $this;
    }
}
