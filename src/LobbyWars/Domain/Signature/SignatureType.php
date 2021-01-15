<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

interface SignatureType
{
    public function type(): Type;

    public function points(): Points;
}
