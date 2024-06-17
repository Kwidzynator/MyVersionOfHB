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

    #[ORM\ManyToOne(targetEntity: Login::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?int $user_id = null;

    #[ORM\Column]
    private ?int $numbers_remembered = null;

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
