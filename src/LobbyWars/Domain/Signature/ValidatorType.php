<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

final class ValidatorType implements SignatureType
{
    private const TYPE = 'V';
    private const POINTS = 1;

    public function type(): Type
    {
        return new Type(self::TYPE);
    }

    public function points(): Points
    {
        return new Points(self::POINTS);
    }
}
