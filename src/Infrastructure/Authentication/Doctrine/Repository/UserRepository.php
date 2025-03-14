<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Doctrine\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Authentication\Entity\User;
use Domain\Authentication\Repository\UserRepositoryInterface;
use Infrastructure\Shared\Doctrine\Repository\AbstractRepository;

/**
 * class UserRepository
 */
final class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail(string $email): ?User
    {
        try {
            /** @var User|null $result */
            $result = $this->createQueryBuilder('u')
                ->where('u.email = :email')
                ->setParameter('email', $email)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();

            return $result;
        } catch (NonUniqueResultException) {
            return null;
        }
    }

    /**
     * @param string $name
     * @return User|null
     */
    public function findOneByUsername(string $name): ?User
    {
        try {
            /** @var User|null $result */
            $result = $this->createQueryBuilder('u')
                ->where('u.username = :username')
                ->setParameter('username', $name)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();

            return $result;
        } catch (NonUniqueResultException) {
            return null;
        }
    }

    /**
     * @param string $emailOrUsername
     * @return User|null
     */
    public function findOneByEmailOrUsername(string $emailOrUsername): ?User
    {
        try {
            /** @var User|null $result */
            $result = $this->createQueryBuilder('u')
                ->where('LOWER(u.email) = :identifier')
                ->orWhere('LOWER(u.username) = :identifier')
                ->setParameter('identifier', mb_strtolower($emailOrUsername))
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();

            return $result;
        } catch (NonUniqueResultException) {
            return null;
        }
    }

    /**
     * @param User $user
     * @param string $password
     * @return void
     */
    public function upgradePassword(User $user, string $password): void
    {
        $user->setPassword($password);
        $this->save($user);
    }
}