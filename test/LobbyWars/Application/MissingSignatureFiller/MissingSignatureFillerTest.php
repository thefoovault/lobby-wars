<?php

declare(strict_types=1);

namespace Test\LobbyWars\Application\MissingSignatureFiller;

use LobbyWars\Application\MissingSignatureFiller\MissingSignatureFiller;
use LobbyWars\Application\MissingSignatureFiller\MissingSignatureFillerQuery;
use LobbyWars\Application\MissingSignatureFiller\MissingSignatureFillerResponse;
use LobbyWars\Domain\Contract\BothSignaturesWithEmptySignature;
use LobbyWars\Domain\Contract\BothSignaturesWithoutEmptySignature;
use LobbyWars\Domain\Contract\MissingSignatureCannotBeSolved;
use LobbyWars\Domain\Contract\MissingSignatureFillerService;
use LobbyWars\Domain\Signature\EmptySignature;
use LobbyWars\Domain\Signature\King;
use LobbyWars\Domain\Signature\Notary;
use LobbyWars\Domain\Signatures\SignatureWithMoreThanOneEmptyValue;
use PHPUnit\Framework\TestCase;
use Shared\Domain\Bus\Query\QueryResponse;

class MissingSignatureFillerTest extends TestCase
{
    private MissingSignatureFiller $missingSignatureFiller;

    protected function setUp(): void
    {
        $this->missingSignatureFiller = new MissingSignatureFiller(
            new MissingSignatureFillerService()
        );
    }

    protected function tearDown(): void
    {
        unset($this->missingSignatureFiller);
    }

    /** @test */
    public function Should_ReturnValidSignature_FromValidData(): void
    {
        /** @var MissingSignatureFillerResponse $result */
        $result = $this->missingSignatureFiller->exec(
            new MissingSignatureFillerQuery(
                Notary::TYPE,
                EmptySignature::TYPE
            )
        );
        $this->assertInstanceOf(QueryResponse::class, $result);
        $this->assertEquals(King::TYPE, $result->signature());
    }

    /** @test */
    public function Should_ThrowSignatureWithMoreThanOneEmptyValue(): void
    {
        $this->expectException(SignatureWithMoreThanOneEmptyValue::class);
        $this->missingSignatureFiller->exec(
            new MissingSignatureFillerQuery(
                Notary::TYPE,
                EmptySignature::TYPE.EmptySignature::TYPE
            )
        );
    }

    /** @test */
    public function Should_ThrowBothSignaturesWithEmptySignature(): void
    {
        $this->expectException(BothSignaturesWithEmptySignature::class);
        $this->missingSignatureFiller->exec(
            new MissingSignatureFillerQuery(
                EmptySignature::TYPE,
                EmptySignature::TYPE
            )
        );
    }

    /** @test */
    public function Should_ThrowBothSignaturesWithourEmptySignature(): void
    {
        $this->expectException(BothSignaturesWithoutEmptySignature::class);
        $this->missingSignatureFiller->exec(
            new MissingSignatureFillerQuery(
                Notary::TYPE,
                Notary::TYPE
            )
        );
    }

    /** @test */
    public function Should_ThrowMissingSignatureCannotBeSolved(): void
    {
        $this->expectException(MissingSignatureCannotBeSolved::class);
        $this->missingSignatureFiller->exec(
            new MissingSignatureFillerQuery(
                King::TYPE,
                EmptySignature::TYPE
            )
        );
    }
}
