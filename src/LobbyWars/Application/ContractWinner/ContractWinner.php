<?php

declare(strict_types=1);

namespace LobbyWars\Application\ContractWinner;

use LobbyWars\Domain\Contract\ContractWinnerService;
use Shared\Domain\Bus\Query\Query;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Domain\Bus\Query\QueryResponse;

final class ContractWinner implements QueryHandler
{
    private ContractWinnerService $contractWinnerService;

    public function __construct(ContractWinnerService $contractWinnerService)
    {
        $this->contractWinnerService = $contractWinnerService;
    }

    public function __invoke(ContractWinnerQuery $query): QueryResponse
    {
        return $this->exec($query);
    }

    public function exec(Query $query): QueryResponse
    {
        /** @var ContractWinnerQuery $query */
        $winner = $this->contractWinnerService->getWinner(
            $query->firstSignaturesGroup(),
            $query->secondSignaturesGroup()
        );

        return new ContractWinnerResponse(
            $winner->signatures()
        );
    }
}
