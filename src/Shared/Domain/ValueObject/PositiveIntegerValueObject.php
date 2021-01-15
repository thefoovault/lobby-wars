<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

abstract class PositiveIntegerValueObject
{
    private int $value;

    public function __construct(int $value)
    {
        $this->assertPositive($value);
        $this->value = $value;
    }

    private function assertPositive(int $value)
    {
        if ($value < 0) {
            throw new InvalidPositiveIntegerValue($value);
        }
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value();
    }
}
