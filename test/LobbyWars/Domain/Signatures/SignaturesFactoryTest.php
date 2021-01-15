<?php

declare(strict_types=1);

namespace Test\LobbyWars\Domain\Signatures;

use LobbyWars\Domain\Signature\EmptySignature;
use LobbyWars\Domain\Signature\InvalidSignature;
use LobbyWars\Domain\Signature\Notary;
use LobbyWars\Domain\Signatures\SignatureCannotHaveEmptyValue;
use LobbyWars\Domain\Signatures\Signatures;
use LobbyWars\Domain\Signatures\SignaturesFactory;
use LobbyWars\Domain\Signatures\SignatureWithMoreThanOneEmptyValue;
use PHPUnit\Framework\TestCase;

class SignaturesFactoryTest extends TestCase
{
    /** @test */
    public function Should_ReturnValidSignaturesWithoutEmptySignatures(): void
    {
        $signatures = SignaturesFactory::createWithoutEmptySignatures(Notary::TYPE);
        $this->assertInstanceOf(Signatures::class, $signatures);
        $this->assertEquals(Notary::TYPE, $signatures->signatures());
    }

    /** @test */
    public function Should_ReturnValidSignaturesWithEmptySignatures(): void
    {
        $signatures = SignaturesFactory::createWithMaximumOneEmptySignature(EmptySignature::TYPE);
        $this->assertInstanceOf(Signatures::class, $signatures);
        $this->assertEquals(EmptySignature::TYPE, $signatures->signatures());
    }

    /** @test */
    public function Should_ThrowSignatureCannotHaveEmptyValue(): void
    {
        $this->expectException(SignatureCannotHaveEmptyValue::class);

        SignaturesFactory::createWithoutEmptySignatures(EmptySignature::TYPE);
    }

    /** @test */
    public function Should_ThrowSignatureCannotHaveMoreThanOneEmptyValue(): void
    {
        $this->expectException(SignatureWithMoreThanOneEmptyValue::class);

        SignaturesFactory::createWithMaximumOneEmptySignature(EmptySignature::TYPE . EmptySignature::TYPE);
    }

    /** @test */
    public function Should_ThrowInvalidSignature(): void
    {
        $this->expectException(InvalidSignature::class);

        SignaturesFactory::createWithoutEmptySignatures('');
    }
}
