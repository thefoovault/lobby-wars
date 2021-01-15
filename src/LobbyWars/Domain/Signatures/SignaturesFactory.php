<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signatures;

use LobbyWars\Domain\Signature\SignatureTypeFactory;

class SignaturesFactory
{
    private function __construct()
    {
    }

    public static function create(string $plainSignatures): Signatures
    {
        $signatures = str_split($plainSignatures);
        $signaturesCollection = [];

        foreach ($signatures as $signature) {
            $signaturesCollection[] = SignatureTypeFactory::create($signature);
        }

        return new Signatures($signaturesCollection);
    }
}
