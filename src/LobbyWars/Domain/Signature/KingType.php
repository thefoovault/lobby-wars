<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

class KingType implements SignatureType
{
    private const TYPE = 'K';
    private const POINTS = 5;

    public function type(): Type
    {
        return new Type(self::TYPE);
    }

    public function points(): Points
    {
        return new Points(self::POINTS);
    }
}
