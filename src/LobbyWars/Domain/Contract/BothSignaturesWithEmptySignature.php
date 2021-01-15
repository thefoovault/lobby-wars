<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Contract;

use Shared\Domain\DomainError;

class BothSignaturesWithEmptySignature extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    function errorMessage(): string
    {
        return 'Both signatures have an empty signature';
    }
}
