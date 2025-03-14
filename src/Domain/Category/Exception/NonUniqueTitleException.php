<?php

declare(strict_types=1);

namespace Domain\Category\Exception;

use Domain\Shared\Exception\SafeMessageException;
use Throwable;

/**
 * class NonUniqueTitleException
 */
final class NonUniqueTitleException extends SafeMessageException
{
    protected string $messageDomain = 'category';

    public function __construct(
        string $message = 'link.exceptions.non_unique_title',
        array $messageData = [],
        int $code = 0,
        Throwable $previous = null
    ){
        parent::__construct($message, $messageData, $code, $previous);
    }
}