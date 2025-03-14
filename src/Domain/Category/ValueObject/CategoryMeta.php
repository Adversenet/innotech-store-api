<?php

namespace Domain\Category\ValueObject;

class CategoryMeta
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $description,
        public readonly ?string $icon,
        public readonly bool $status
    ){
    }

    public static function fromArray(array $data): self
    {
        return new self(
         $data['title'] ?? null,
         $data['description'] ?? null,
         $data['icon'] ?? null,
         $data['status']
        );
    }
}