<?php

declare(strict_types=1);

namespace Domain\Authentication\Entity;

use AllowDynamicProperties;
use Domain\Authentication\ValueObject\Roles;
use Domain\Shared\Entity\IdentityTrait;
use Domain\Shared\Entity\TimestampTrait;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * class User
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use IdentityTrait;
    use TimestampTrait;

    private ?string $name = null;
    private ?string $email = null;

    private Roles $roles;
    private ?string $password = null;

    public function __construct()
    {
        $this->roles = Roles::user();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): User
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles->toArray();
    }

    public function setRoles(Roles|array $roles): User
    {
        $this->roles = match (true) {
            $roles instanceof Roles => $roles,
            default => Roles::fromArray($roles)
        };
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

}