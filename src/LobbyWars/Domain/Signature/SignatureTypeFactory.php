<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

final class SignatureTypeFactory
{
    private const KING = 'K';
    private const NOTARY = 'N';
    private const VALIDATOR = 'V';
    private const VALID_TYPES = [
        self::KING,
        self::NOTARY,
        self::VALIDATOR
    ];

    private function __construct()
    {
    }

    public static function create(string $signatureType): SignatureType
    {
        self::assertValidType($signatureType);

        switch ($signatureType) {
            case self::KING: return new KingType(); break;
            case self::NOTARY: return new NotaryType(); break;
            case self::VALIDATOR: return new ValidatorType(); break;
        }
    }

    private static function assertValidType(string $signatureType): void
    {
        if (!in_array($signatureType, self::VALID_TYPES)) {
            throw new InvalidSignature($signatureType);
        }
    }
}
