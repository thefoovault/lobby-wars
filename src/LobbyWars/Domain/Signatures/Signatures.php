<?php

declare(strict_types=1);

namespace LobbyWars\Domain\Signatures;

use LobbyWars\Domain\Signature\EmptySignature;
use LobbyWars\Domain\Signature\King;
use LobbyWars\Domain\Signature\Points;
use LobbyWars\Domain\Signature\SignatureType;
use LobbyWars\Domain\Signature\Type;
use LobbyWars\Domain\Signature\Validator;
use Shared\Domain\Collection;

final class Signatures extends Collection
{
    public function __construct(array $signatures)
    {
        parent::__construct($signatures);
    }

    protected function type(): string
    {
        return SignatureType::class;
    }

    public function totalPoints(): Points
    {
        $points = new Points(0);
        $hasKingSignature = $this->hasKingSignature();
        /** @var SignatureType $signature */
        foreach ($this->items() as $signature) {
            $isValidatorType = $this->isValidatorType($signature->type());
            if (!($hasKingSignature && $isValidatorType)) {
                $points = $points->add($signature->points());
            }
        }

        return $points;
    }

    private function hasKingSignature()
    {
        /** @var SignatureType $signature */
        foreach ($this->items() as $signature) {
            if ($signature->type()->value() === King::TYPE) {
                return true;
            }
        }

        return false;
    }

    private function isValidatorType(Type $type)
    {
        return $type->value() ===Validator::TYPE;
    }

    public function signatures(): string
    {
        $signatures = '';
        /** @var SignatureType $signature */
        foreach ($this->items() as $signature) {
            $signatures .= $signature->type();
        }

        return $signatures;
    }

    public function hasEmptySignature()
    {
        /** @var SignatureType $signature */
        foreach ($this->items() as $signature) {
            if ($signature->type()->value() === EmptySignature::TYPE) {
                return true;
            }
        }

        return false;
    }
}
