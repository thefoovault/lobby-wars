<?php

declare(strict_types=1);

namespace Test\LobbyWars\Domain\Signatures;

use LobbyWars\Domain\Signature\InvalidSignature;
use LobbyWars\Domain\Signature\Notary;
use LobbyWars\Domain\Signatures\Signatures;
use LobbyWars\Domain\Signatures\SignaturesFactory;
use PHPUnit\Framework\TestCase;

class SignaturesFactoryTest extends TestCase
{
    /** @test */
    public function Should_ReturnValidSignatures()
    {
        $signatures = SignaturesFactory::createWithoutEmptySignatures(Notary::TYPE);
        $this->assertInstanceOf(Signatures::class, $signatures);
        $this->assertEquals(Notary::TYPE, $signatures->signatures());
    }

    /** @test */
    public function Should_ThrowInvalidSignature()
    {
        $this->expectException(InvalidSignature::class);

        SignaturesFactory::createWithoutEmptySignatures('');
    }
}
