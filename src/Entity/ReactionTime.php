<?php

namespace App\Entity;

use App\Repository\ReactionTimeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReactionTimeRepository::class)]
class ReactionTime
{
    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $time = null;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Login::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $user = null; // Correct type for the ManyToOne relationship

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): static
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
