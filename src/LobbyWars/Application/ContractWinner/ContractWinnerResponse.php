<?php

declare(strict_types=1);

namespace LobbyWars\Application\ContractWinner;

use Shared\Domain\Bus\Query\QueryResponse;

class ContractWinnerResponse implements QueryResponse
{
    private string $signatures;

    public function __construct(string $signatures)
    {
        $this->signatures = $signatures;
    }

    public function signatures(): string
    {
        return $this->signatures;
    }
}
