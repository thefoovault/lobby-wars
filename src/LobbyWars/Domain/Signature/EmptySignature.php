<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

class EmptySignature implements SignatureType
{
    public const TYPE = '#';
    private const POINTS = 0;

    public function type(): Type
    {
        return new Type(self::TYPE);
    }

    public function points(): Points
    {
        return new Points(self::POINTS);
    }
}
