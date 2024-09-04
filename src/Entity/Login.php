<?php

namespace App\Entity;

use App\Repository\LoginRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoginRepository::class)]
class Login implements \Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface, \Symfony\Component\Security\Core\User\UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "login", length: 32)]
    private ?string $login = null;

    #[ORM\Column(name: "email", length: 70)]
    private ?string $email = null;
    #[ORM\Column(name: "password", length: 255)]
    private ?string $password = null;

    #[ORM\Column(name: "role", length: 32)]
    private ?string $role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): void
    {
        $this->role = $role;
    }


    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return [$this->role ?? 'ROLE_USER'];
    }
    public function eraseCredentials(): void
    {

    }
}