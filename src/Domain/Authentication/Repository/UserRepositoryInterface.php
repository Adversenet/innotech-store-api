<?php

declare(strict_types=1);

namespace Domain\Authentication\Repository;

use Domain\Authentication\Entity\User;

/**
 * class UserRepositoryInterface
 */
interface UserRepositoryInterface
{
    public function findOneByUsername(string $name): ?User;
    public function findOneByEmail(string $email): ?User;

    public function findOneByEmailOrUsername(string $emailOrUsername): ?User;
    public function upgradePassword(User $user, string $password): void;
}