<?php

declare(strict_types=1);

namespace Domain\Shared\Repository;

/**
 * class DataRepositoryInterface
 */
interface DataRepositoryInterface
{
    public function findAll();

    public function findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null);
    public function findOneBy(array $criteria, array $orderBy = null);

    public function find(mixed $id);

    public function save(object $entity): void;

    public function delete(object $entity): void;

    public function findOrFail(int|string $id): object;

    public function findOneByCaseInsensitive(array $conditions): ?object;

    public function findByCaseInsensitive(array $conditions): array;
}