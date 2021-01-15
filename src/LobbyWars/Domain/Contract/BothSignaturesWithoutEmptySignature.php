<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Contract;

use Shared\Domain\DomainError;

class BothSignaturesWithoutEmptySignature extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    function errorMessage(): string
    {
        return 'Both signatures have not an empty signature';
    }
}
