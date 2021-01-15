<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

interface SignatureType
{
    public function type();

    public function points(): Points;
}
