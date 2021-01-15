<?php

declare(strict_types=1);

namespace LobbyWars\Application\MissingSignatureFiller;

use Shared\Domain\Bus\Query\Query;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Domain\Bus\Query\QueryResponse;
use Shared\Infrastructure\Bus\Query\QueryHandlerWrapper;

class MissingSignatureFiller extends QueryHandlerWrapper implements QueryHandler
{
    public function __construct()
    {
    }

    public function __invoke(MissingSignatureFillerQuery $query): QueryResponse
    {
        return $this->exec($query);
    }

    public function exec(Query $query): QueryResponse
    {
       return new MissingSignatureFillerResponse(
            'test'
        );
    }
}
