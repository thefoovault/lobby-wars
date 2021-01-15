<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Contract;

use LobbyWars\Domain\Signature\King;
use LobbyWars\Domain\Signature\Notary;
use LobbyWars\Domain\Signature\SignatureType;
use LobbyWars\Domain\Signature\SignatureTypeFactory;
use LobbyWars\Domain\Signature\Validator;
use LobbyWars\Domain\Signatures\Signatures;
use LobbyWars\Domain\Signatures\SignaturesFactory;

class MissingSignatureFillerService
{
    private const POSSIBLE_FILLS = [
        Validator::TYPE,
        Notary::TYPE,
        King::TYPE
    ];

    public function fill(string $firstSignaturesGroup, string $secondSignaturesGroup): SignatureType
    {
        $firstSignaturesParty = SignaturesFactory::createWithAnEmptySignature($firstSignaturesGroup);
        $secondSignaturesParty = SignaturesFactory::createWithAnEmptySignature($secondSignaturesGroup);

        $this->assertValidSignatures($firstSignaturesParty, $secondSignaturesParty);

        if ($firstSignaturesParty->hasEmptySignature()) {
            return $this->getMissingSignature($firstSignaturesParty, $secondSignaturesParty);
        } else {
           return $this->getMissingSignature($secondSignaturesParty, $firstSignaturesParty);
        }
    }

    private function assertValidSignatures(Signatures $firstSignaturesParty, Signatures $secondSignaturesParty): void
    {
        $firstHasEmptySignature = $firstSignaturesParty->hasEmptySignature();
        $secondHasEmptySignature = $secondSignaturesParty->hasEmptySignature();

        if ($firstHasEmptySignature && $secondHasEmptySignature) {
            throw new BothSignaturesWithEmptySignature();
        }

        if (!$firstHasEmptySignature && !$secondHasEmptySignature) {
            throw new BothSignaturesWithoutEmptySignature();
        }
    }

    private function getMissingSignature(Signatures $signaturesWithAnEmptySignature, Signatures $signatureComparison): SignatureType
    {
        $totalPointsGoal = $signatureComparison->totalPoints();

        foreach (self::POSSIBLE_FILLS as $possible_fill_type) {
            $signatures = SignaturesFactory::createWithAnEmptySignature($signaturesWithAnEmptySignature->signatures() . $possible_fill_type);

            if ($signatures->totalPoints()->value() > $totalPointsGoal->value()) {
                return SignatureTypeFactory::create($possible_fill_type);
            }
        }

        throw new MissingSignatureCannotBeSolved();
    }
}
