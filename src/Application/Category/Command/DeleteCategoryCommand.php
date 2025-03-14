<?php

declare(strict_types=1);

namespace Application\Category\Command;

use Domain\Category\Entity\Category;

/**
 * class DeleteCategoryCommand
 */
final readonly class DeleteCategoryCommand
{
    public function __construct(
        public Category $_entity
    ){
    }
}