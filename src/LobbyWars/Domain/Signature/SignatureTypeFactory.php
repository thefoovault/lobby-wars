<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signature;

final class SignatureTypeFactory
{
    private const VALID_TYPES = [
        King::TYPE,
        Notary::TYPE,
        Validator::TYPE,
        EmptySignature::TYPE,
    ];

    private function __construct()
    {
    }

    public static function create(string $signatureType): SignatureType
    {
        self::assertValidType($signatureType);

        switch ($signatureType) {
            case King::TYPE: return new King();
            case Notary::TYPE: return new Notary();
            case Validator::TYPE: return new Validator();
            case EmptySignature::TYPE: return new EmptySignature();
        }
    }

    private static function assertValidType(string $signatureType): void
    {
        if (!in_array($signatureType, self::VALID_TYPES)) {
            throw new InvalidSignature($signatureType);
        }
    }
}
