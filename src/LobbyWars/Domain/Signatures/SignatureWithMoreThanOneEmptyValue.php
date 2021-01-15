<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signatures;

use Shared\Domain\DomainError;

class SignatureWithMoreThanOneEmptyValue extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    function errorMessage(): string
    {
        return 'Signatures cannot have more than one empty value';
    }
}
