<?php

namespace App\Entity;

use App\Repository\RememberingNumbersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RememberingNumbersRepository::class)]
class RememberingNumbers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Login::class, inversedBy: 'rememberingNumbers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $user = null;

    #[ORM\Column]
    private ?int $numbers_remembered = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Login
    {
        return $this->user;
    }

    public function setUser(?Login $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getNumbersRemembered(): ?int
    {
        return $this->numbers_remembered;
    }

    public function setNumbersRemembered(int $numbers_remembered): static
    {
        $this->numbers_remembered = $numbers_remembered;

        return $this;
    }
}