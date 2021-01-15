<?php

declare(strict_types=1);

namespace Test\LobbyWars\Application\ContractWinner;

use LobbyWars\Application\ContractWinner\ContractWinner;
use LobbyWars\Application\ContractWinner\ContractWinnerQuery;
use LobbyWars\Application\ContractWinner\ContractWinnerResponse;
use LobbyWars\Domain\Contract\ContractWinnerService;
use LobbyWars\Domain\Signature\Notary;
use LobbyWars\Domain\Signature\Validator;
use PHPUnit\Framework\TestCase;
use Shared\Domain\Bus\Query\QueryResponse;

class ContractWinnerTest extends TestCase
{
    private ContractWinner $contractWinner;

    protected function setUp(): void
    {
        $this->contractWinner = new ContractWinner(
            new ContractWinnerService()
        );
    }

    protected function tearDown(): void
    {
        unset($this->contractWinner);
    }

    /** @test */
    public function Should_ReturnValidContractWinner_FromValidData(): void
    {
        /** @var ContractWinnerResponse $result */
        $result = $this->contractWinner->exec(
            new ContractWinnerQuery(
                Notary::TYPE . Notary::TYPE,
                Validator::TYPE
            )
        );
        $this->assertInstanceOf(QueryResponse::class, $result);
        $this->assertEquals(Notary::TYPE . Notary::TYPE, $result->signatures());
    }
}
