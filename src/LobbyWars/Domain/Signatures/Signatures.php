<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signatures;

use LobbyWars\Domain\Signature\Points;
use LobbyWars\Domain\Signature\SignatureType;
use Shared\Domain\Collection;

final class Signatures extends Collection
{
    public function __construct(array $signatures)
    {
        parent::__construct($signatures);
    }

    protected function type(): string
    {
        return SignatureType::class;
    }

    public function totalPoints(): Points
    {
        $points = 0;
        /** @var SignatureType $item */
        foreach ($this->items() as $signature) {
            $points += $signature->points()->value();
        }

        return new Points($points);
    }

    public function signatures(): string
    {
        $signatures = '';
        /** @var SignatureType $signature */
        foreach ($this->items() as $signature) {
            $signatures .= $signature->type();
        }

        return $signatures;
    }
}
