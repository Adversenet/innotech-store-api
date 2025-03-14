<?php

declare(strict_types=1);

namespace Application\Authentication\Command;

/**
 * class LoginCommand
 */
final class LoginCommand
{
    public function __construct(
        public ?string $identifier = null,
        public ?string $password = null
    ){
    }
}