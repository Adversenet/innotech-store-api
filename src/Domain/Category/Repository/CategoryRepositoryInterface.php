<?php

declare(strict_types=1);

namespace Domain\Category\Repository;

use Domain\Shared\Repository\DataRepositoryInterface;

/**
 * class CategoryRepositoryInterface
 */
interface CategoryRepositoryInterface extends DataRepositoryInterface
{
    public function isUniqueTitle(string $title): string;
}