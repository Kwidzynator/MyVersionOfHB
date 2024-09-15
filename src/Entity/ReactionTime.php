<?php

namespace App\Entity;

use App\Repository\ReactionTimeRepository;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReactionTimeRepository::class)]
class ReactionTime
{
    #[ORM\Column(type: 'float')]
    private ?float $time = null;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Login::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $user = null; // Correct type for the ManyToOne relationship

    public function getTime(): float
    {
        return $this->time;
    }

    public function setTime(float $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

}
