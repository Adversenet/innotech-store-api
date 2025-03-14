<?php

declare(strict_types=1);

namespace Infrastructure\Category\Doctrine\Repository;

use Domain\Category\Entity\Category;
use Domain\Category\Repository\CategoryRepositoryInterface;
use Infrastructure\Shared\Doctrine\Repository\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * class CategoryRepository
 */
final class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function isUniqueTitle(string $title): string
    {
        return $title;
    }
}