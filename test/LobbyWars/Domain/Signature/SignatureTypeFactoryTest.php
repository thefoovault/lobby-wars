<?php

declare(strict_types=1);

namespace Test\LobbyWars\Domain\Signature;

use LobbyWars\Domain\Signature\InvalidSignature;
use LobbyWars\Domain\Signature\King;
use LobbyWars\Domain\Signature\Notary;
use LobbyWars\Domain\Signature\SignatureTypeFactory;
use LobbyWars\Domain\Signature\Validator;
use PHPUnit\Framework\TestCase;

class SignatureTypeFactoryTest extends TestCase
{
    /** @test */
    public function Should_ReturnKing(): void
    {
        $kingSignature = SignatureTypeFactory::create(King::TYPE);
        $this->assertInstanceOf(King::class, $kingSignature);
    }

    /** @test */
    public function Should_ReturnNotary(): void
    {
        $notarySignature = SignatureTypeFactory::create(Notary::TYPE);
        $this->assertInstanceOf(Notary::class, $notarySignature);
    }

    /** @test */
    public function Should_ReturnValidator(): void
    {
        $validatorSignature = SignatureTypeFactory::create(Validator::TYPE);
        $this->assertInstanceOf(Validator::class, $validatorSignature);
    }

    /** @test */
    public function Should_ThrowInvalidSignature(): void
    {
        $this->expectException(InvalidSignature::class);

        SignatureTypeFactory::create('');
    }
}
