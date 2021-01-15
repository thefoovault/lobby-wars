<?php

declare(strict_types=1);

namespace LobbyWars\Application\MissingSignatureFiller;

use LobbyWars\Domain\Contract\MissingSignatureFillerService;
use Shared\Domain\Bus\Query\Query;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Domain\Bus\Query\QueryResponse;

class MissingSignatureFiller implements QueryHandler
{
    private MissingSignatureFillerService $missingSignatureFillerService;

    public function __construct(MissingSignatureFillerService $missingSignatureFillerService)
    {
        $this->missingSignatureFillerService = $missingSignatureFillerService;
    }

    public function __invoke(MissingSignatureFillerQuery $query): QueryResponse
    {
        return $this->exec($query);
    }

    public function exec(Query $query): QueryResponse
    {
        /** @var MissingSignatureFillerQuery $query */
        $result = $this->missingSignatureFillerService->fill(
            $query->firstSignaturesGroup(),
            $query->secondSignaturesGroup()
        );

       return new MissingSignatureFillerResponse(
            $result->type()->value()
        );
    }
}
