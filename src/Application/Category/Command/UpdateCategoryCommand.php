<?php

declare(strict_types=1);

namespace Application\Category\Command;

use Application\Shared\Mapper;
use Domain\Category\Entity\Category;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class UpdateCategoryCommand
 */
final class UpdateCategoryCommand
{
    public function __construct(
        public readonly Category $_entity,
        #[Assert\NotBlank] public ?string $title = null,
        #[Assert\Length(max: 500)] public ?string $description = null,
    )
    {
        Mapper::hydrate($this, $_entity);
    }
}