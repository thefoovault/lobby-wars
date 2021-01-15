<?php

declare(strict_types=1);

namespace Test\LobbyWars\Domain\Signatures;

use LobbyWars\Domain\Signature\King;
use LobbyWars\Domain\Signature\Notary;
use LobbyWars\Domain\Signature\Points;
use LobbyWars\Domain\Signature\SignatureTypeFactory;
use LobbyWars\Domain\Signature\Validator;
use LobbyWars\Domain\Signatures\Signatures;
use PHPUnit\Framework\TestCase;

class SignaturesTest extends TestCase
{
    /** @test */
    public function Should_ReturnCorrectSignaturesText_GivenMultipleSignatures()
    {
        $kingSignature = SignatureTypeFactory::create(King::TYPE);
        $notarySignature = SignatureTypeFactory::create(Notary::TYPE);

        $expectedSignatureText = King::TYPE . Notary::TYPE;

        $signatures = new Signatures([
            $kingSignature,
            $notarySignature
        ]);

        $this->assertEquals($expectedSignatureText, $signatures->signatures());
    }

    /** @test */
    public function Should_ReturnCorrectPoints_GivenAKing()
    {
        $kingSignature = SignatureTypeFactory::create(King::TYPE);

        $signatures = new Signatures([
            $kingSignature
        ]);
        $points = $signatures->totalPoints();

        $this->assertInstanceOf(Points::class, $points);
        $this->assertEquals($kingSignature->points()->value(), $points->value());
    }

    /** @test */
    public function Should_ReturnCorrectPoints_GivenANotary()
    {
        $notarySignature = SignatureTypeFactory::create(Notary::TYPE);

        $signatures = new Signatures([
            $notarySignature
        ]);
        $points = $signatures->totalPoints();

        $this->assertInstanceOf(Points::class, $points);
        $this->assertEquals($notarySignature->points()->value(), $points->value());
    }

    /** @test */
    public function Should_ReturnCorrectPoints_GivenAValidator()
    {
        $validatorSignature = SignatureTypeFactory::create(Validator::TYPE);

        $signatures = new Signatures([
            $validatorSignature
        ]);
        $points = $signatures->totalPoints();

        $this->assertInstanceOf(Points::class, $points);
        $this->assertEquals($validatorSignature->points()->value(), $points->value());
    }

    /** @test */
    public function Should_ReturnCorrectPoints_GivenAKingAndValidator()
    {
        $kingSignature = SignatureTypeFactory::create(King::TYPE);
        $validatorSignature = SignatureTypeFactory::create(Validator::TYPE);

        $signatures = new Signatures([
            $kingSignature,
            $validatorSignature
        ]);
        $points = $signatures->totalPoints();

        $this->assertInstanceOf(Points::class, $points);
        $this->assertEquals($kingSignature->points()->value(), $points->value());
    }

    /** @test */
    public function Should_ReturnCorrectPoints_GivenMultipleSignatures()
    {
        $kingSignature = SignatureTypeFactory::create(King::TYPE);
        $notarySignature = SignatureTypeFactory::create(Notary::TYPE);

        $expectedPoints = $kingSignature->points()->value() + $notarySignature->points()->value();

        $signatures = new Signatures([
            $kingSignature,
            $notarySignature
        ]);
        $points = $signatures->totalPoints();

        $this->assertInstanceOf(Points::class, $points);
        $this->assertEquals($expectedPoints, $points->value());
    }
}
