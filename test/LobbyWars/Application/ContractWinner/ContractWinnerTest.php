<?php

declare(strict_types=1);

namespace Test\LobbyWars\Application\ContractWinner;

use LobbyWars\Application\ContractWinner\ContractWinner;
use LobbyWars\Application\ContractWinner\ContractWinnerQuery;
use LobbyWars\Application\ContractWinner\ContractWinnerResponse;
use LobbyWars\Domain\Contract\ContractWinnerService;
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
    public function Should_ReturnValidContractWinner_FromValidData()
    {
        /** @var ContractWinnerResponse $result */
        $result = $this->contractWinner->exec(new ContractWinnerQuery('NN', 'VV'));
        $this->assertInstanceOf(QueryResponse::class, $result);
        $this->assertEquals('NN', $result->signatures());
    }
}
