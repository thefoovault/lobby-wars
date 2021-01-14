<?php

declare(strict_types=1);

namespace LobbyWars\Application\ContractWinner;

use Shared\Domain\Bus\Query\Query;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Domain\Bus\Query\QueryResponse;
use Shared\Infrastructure\Bus\Query\QueryHandlerWrapper;

class ContractWinner extends QueryHandlerWrapper implements QueryHandler
{
    public function __invoke(ContractWinnerQuery $query): ContractWinnerResponse
    {
        $this->exec($query);
    }

    public function exec(Query $query): QueryResponse
    {
        return new ContractWinnerResponse();
    }
}
