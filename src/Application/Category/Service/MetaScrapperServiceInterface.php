<?php

declare(strict_types=1);

namespace Application\Category\Service;

use Domain\Category\ValueObject\CategoryMeta;

/**
 * class MetaScrapperServiceInterface
 */
interface MetaScrapperServiceInterface
{
    public function getMeta(string $title): ?CategoryMeta;
}