<?php

declare(strict_types=1);

namespace Infrastructure\Shared\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Shared\Repository\DataRepositoryInterface;

/**
 * class AbstractRepository
 */
class AbstractRepository extends ServiceEntityRepository implements DataRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     * @param string $entityClass
     */
    public function __construct(ManagerRegistry $registry, string $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    public function findOrFail(int|string $id): object
    {
        $entity = $this->find($id, null, null);
        if ($entity === null) {
            throw EntityNotFoundException::fromClassNameAndIdentifier($this->_entityName, [(string) $id]);
        }

        return $entity;
    }

    public function findByCaseInsensitive(array $conditions): array
    {

        $result = $this->findByCaseInsensitiveQuery($conditions)->getResult();

        return $result;
    }

    public function findOneByCaseInsensitive(array $conditions): ?object
    {
        $result = $this->findByCaseInsensitiveQuery($conditions)
            ->setMaxResults(1)
            ->getOneOrNullResult();

        return $result;
    }

    public function save(object $entity, bool $flush = true): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(object $entity, bool $flush = true): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    protected function findByCaseInsensitiveQuery(array $conditions): Query
    {
        $conditionString = [];
        $parameters = [];
        foreach ($conditions as $k => $v) {
            $conditionString[] = "LOWER(o.{$k}) = :{$k}";
            $parameters[$k] = strtolower($v);
        }

        return $this->createQueryBuilder('o')
            ->where(join(' AND ', $conditionString))
            ->setParameters($parameters)
            ->getQuery();
    }
}