<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Contract;

use Shared\Domain\DomainError;

class MissingSignatureCannotBeSolved extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    function errorMessage(): string
    {
        return 'The missing signature cannot be solved';
    }
}
