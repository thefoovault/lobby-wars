<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use Shared\Domain\DomainError;

class InvalidPositiveIntegerValue extends DomainError
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
        parent::__construct();
    }

    function errorMessage(): string
    {
        return sprintf('Invalid value %i', $this->value);
    }
}
