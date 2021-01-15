<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Contract;

use LobbyWars\Domain\Signatures\Signatures;
use LobbyWars\Domain\Signatures\SignaturesFactory;

class ContractWinnerService
{
    public function getWinner(string $firstSignaturesGroup, string $secondSignaturesGroup): Signatures
    {
        $contract = new Contract(
            SignaturesFactory::create($firstSignaturesGroup),
            SignaturesFactory::create($secondSignaturesGroup)
        );

        return $contract->winner();
    }
}
