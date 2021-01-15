<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signatures;

use LobbyWars\Domain\Signature\EmptySignature;
use LobbyWars\Domain\Signature\SignatureTypeFactory;

class SignaturesFactory
{
    private function __construct()
    {
    }

    public static function createWithoutEmptySignatures(string $plainSignatures): Signatures
    {
        $signatures = str_split($plainSignatures);
        $signaturesCollection = [];

        foreach ($signatures as $signature) {
            if ($signature === EmptySignature::TYPE) {
                throw new SignatureCannotHaveEmptyValue();
            }
            $signaturesCollection[] = SignatureTypeFactory::create($signature);
        }

        return new Signatures($signaturesCollection);
    }

    public static function createWithMaximumOneEmptySignature(string $plainSignatures): Signatures
    {
        $signatures = str_split($plainSignatures);
        $signaturesCollection = [];

        $hasEmptySignature = false;
        foreach ($signatures as $signature) {
            if (EmptySignature::TYPE === $signature) {
                if ($hasEmptySignature) {
                    throw new SignatureWithMoreThanOneEmptyValue();
                }
                $hasEmptySignature = true;
            }
            $signaturesCollection[] = SignatureTypeFactory::create($signature);
        }

        return new Signatures($signaturesCollection);
    }
}
