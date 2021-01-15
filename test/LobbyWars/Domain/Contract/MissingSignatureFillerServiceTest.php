<?php

declare(strict_types=1);

namespace Test\LobbyWars\Domain\Contract;

use LobbyWars\Domain\Contract\BothSignaturesWithEmptySignature;
use LobbyWars\Domain\Contract\BothSignaturesWithoutEmptySignature;
use LobbyWars\Domain\Contract\MissingSignatureCannotBeSolved;
use LobbyWars\Domain\Contract\MissingSignatureFillerService;
use LobbyWars\Domain\Signature\EmptySignature;
use LobbyWars\Domain\Signature\King;
use LobbyWars\Domain\Signature\Notary;
use LobbyWars\Domain\Signature\SignatureType;
use PHPUnit\Framework\TestCase;

class MissingSignatureFillerServiceTest extends TestCase
{
    private MissingSignatureFillerService $missingSignatureFillerService;

    public function setUp(): void
    {
        $this->missingSignatureFillerService = new MissingSignatureFillerService();
    }

    /** @test */
    public function Should_ReturnValidKingSignature_GivenNotaryAndEmptySignature(): void
    {
        $result = $this->missingSignatureFillerService->fill(Notary::TYPE, EmptySignature::TYPE);

        $this->assertInstanceOf(SignatureType::class, $result);
        $this->assertEquals(King::TYPE, $result->type());
    }

    /** @test */
    public function Should_ReturnValidNotarySignature_GivenAKingAndAKingEmptySignature(): void
    {
        $result = $this->missingSignatureFillerService->fill(King::TYPE, King::TYPE . EmptySignature::TYPE);

        $this->assertInstanceOf(SignatureType::class, $result);
        $this->assertEquals(Notary::TYPE, $result->type());
    }

    /** @test */
    public function Should_ThrowBothSignaturesWithEmptySignature(): void
    {
        $this->expectException(BothSignaturesWithEmptySignature::class);

        $this->missingSignatureFillerService->fill(EmptySignature::TYPE, EmptySignature::TYPE);
    }

    /** @test */
    public function Should_ThrowBothSignaturesWithoutEmptySignature(): void
    {
        $this->expectException(BothSignaturesWithoutEmptySignature::class);

        $this->missingSignatureFillerService->fill(King::TYPE, Notary::TYPE);
    }

    /** @test */
    public function Should_ThrowMissingSignatureCannotBeSolved(): void
    {
        $this->expectException(MissingSignatureCannotBeSolved::class);

        $this->missingSignatureFillerService->fill(King::TYPE, EmptySignature::TYPE);
    }
}
