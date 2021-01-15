<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

class NotaryType implements SignatureType
{
    private const TYPE = 'N';
    private const POINTS = 2;

    public function type(): Type
    {
        return new Type(self::TYPE);
    }

    public function points(): Points
    {
        return new Points(self::POINTS);
    }
}
