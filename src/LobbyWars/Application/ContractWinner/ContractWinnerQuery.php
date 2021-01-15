<?php

declare(strict_types=1);

namespace LobbyWars\Application\ContractWinner;

use Shared\Domain\Bus\Query\Query;

final class ContractWinnerQuery implements Query
{
    private string $firstSignaturesGroup;
    private string $secondSignaturesGroup;

    public function __construct(string $firstSignaturesGroup, string $secondSignaturesGroup)
    {
        $this->firstSignaturesGroup = $firstSignaturesGroup;
        $this->secondSignaturesGroup = $secondSignaturesGroup;
    }

    public function firstSignaturesGroup(): string
    {
        return $this->firstSignaturesGroup;
    }

    public function secondSignaturesGroup(): string
    {
        return $this->secondSignaturesGroup;
    }
}
