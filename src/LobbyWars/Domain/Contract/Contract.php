<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Contract;

use LobbyWars\Domain\Signatures\Signatures;

final class Contract
{
    private array $signatures;

    public function __construct(Signatures ...$signatures)
    {
        $this->signatures = $signatures;
    }

    public function winner(): Signatures
    {
        $winner = array_shift($this->signatures);
        foreach ($this->signatures as $signature) {
            if ($signature->totalPoints()->value() > $winner->totalPoints()->value()) {
                $winner = $signature;
            }
        }

        return $winner;
    }
}
