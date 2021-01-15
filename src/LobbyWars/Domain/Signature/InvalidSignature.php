<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

use Shared\Domain\DomainError;

class InvalidSignature extends DomainError
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
        parent::__construct();
    }

    function errorMessage(): string
    {
        return sprintf('This signature (%s) is invalid', $this->value);
    }
}
