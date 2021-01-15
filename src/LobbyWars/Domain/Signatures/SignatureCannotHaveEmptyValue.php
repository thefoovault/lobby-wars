<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signatures;

use Shared\Domain\DomainError;

class SignatureCannotHaveEmptyValue extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    function errorMessage(): string
    {
        return 'The signatures cannot be empty';
    }
}
