<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

final class Validator implements SignatureType
{
    public const TYPE = 'V';
    public const POINTS = 1;

    public function type(): Type
    {
        return new Type(self::TYPE);
    }

    public function points(): Points
    {
        return new Points(self::POINTS);
    }
}
