<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

final class King implements SignatureType
{
    public const TYPE = 'K';
    public const POINTS = 5;

    public function type(): Type
    {
        return new Type(self::TYPE);
    }

    public function points(): Points
    {
        return new Points(self::POINTS);
    }
}
