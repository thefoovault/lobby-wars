<?php

declare(strict_types=1);

namespace LobbyWars\Application\MissingSignatureFiller;

use Shared\Domain\Bus\Query\QueryResponse;

class MissingSignatureFillerResponse implements QueryResponse
{
    private string $signature;

    public function __construct(string $signature)
    {
        $this->signature = $signature;
    }

    public function signature(): string
    {
        return $this->signature;
    }
}
