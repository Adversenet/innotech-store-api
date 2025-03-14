<?php

declare(strict_types=1);

namespace Application\Category\Command;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * class CreateCategoryCommand
 */
final class CreateCategoryCommand
{
    public function __construct(
        #[Assert\NotBlank] public ?string $title = null,
        #[Assert\Length(max: 500)] public ?string $description = null,
        #[Assert\Length(max: 500)] public ?string $icon = null,
        #[Assert\NotBlank] public bool $status = false,
    ){
    }
}