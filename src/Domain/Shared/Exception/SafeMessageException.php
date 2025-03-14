<?php

declare(strict_types=1);

namespace Domain\Shared\Exception;

use DomainException;
use Throwable;

/**
 * class SafeMessageException
 */
class SafeMessageException extends DomainException
{
    protected string $messageKey = '';
    protected string $messageDomain = 'messages';
    protected array $messageData = [];

    public function __construct(string $message = '', array $messageData = [], int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->setSafeMessage($message, $messageData);
    }

    public function setSafeMessage(string $messageKey, array $messageData = []): void
    {
        $this->messageKey = $messageKey;
        $this->messageData = $messageData;
    }

    public function getMessageKey(): string
    {
        return $this->messageKey;
    }

    public function getMessageData(): array
    {
        return $this->messageData;
    }

    public function getMessageDomain(): string
    {
        return $this->messageDomain;
    }
}