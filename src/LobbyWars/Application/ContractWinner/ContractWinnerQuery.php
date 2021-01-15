<?php

declare(strict_types=1);

namespace LobbyWars\Application\ContractWinner;

use Shared\Domain\Bus\Query\Query;

final class ContractWinnerQuery implements Query
{
    private string $firstContract;
    private string $secondContract;

    public function __construct(string $firstContract, string $secondContract)
    {
        $this->firstContract = $firstContract;
        $this->secondContract = $secondContract;
    }

    public function firstContract(): string
    {
        return $this->firstContract;
    }

    public function secondContract(): string
    {
        return $this->secondContract;
    }
}