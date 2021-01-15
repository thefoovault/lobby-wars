<?php

declare(strict_types=1);

namespace Test\LobbyWars\Domain\Contract;

use LobbyWars\Domain\Contract\ContractWinnerService;
use LobbyWars\Domain\Signature\InvalidSignature;
use LobbyWars\Domain\Signature\King;
use LobbyWars\Domain\Signature\Notary;
use LobbyWars\Domain\Signatures\Signatures;
use PHPUnit\Framework\TestCase;

class ContractWinnerServiceTest extends TestCase
{
    private ContractWinnerService $contractWinnerService;

    public function setUp(): void
    {
        $this->contractWinnerService = new ContractWinnerService();
    }

    /** @test */
    public function Should_ReturnValidWinner()
    {
        $winner = $this->contractWinnerService->getWinner(King::TYPE, Notary::TYPE);
        $this->assertInstanceOf(Signatures::class, $winner);
        $this->assertEquals(King::TYPE, $winner->signatures());
    }

    /** @test */
    public function Should_ThrowInvalidSignature()
    {
        $this->expectException(InvalidSignature::class);
        $this->contractWinnerService->getWinner(King::TYPE, '');
    }
}
