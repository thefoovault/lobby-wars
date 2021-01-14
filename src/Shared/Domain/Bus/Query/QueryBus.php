<?php

declare(strict_types=1);

namespace Shared\Domain\Bus\Query;

interface QueryBus
{
    public function dispatch(Query $query): QueryResponse;
}
