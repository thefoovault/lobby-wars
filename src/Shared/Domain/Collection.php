<?php

declare(strict_types=1);

namespace Shared\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;

use Traversable;
use function count;

abstract class Collection implements Countable, IteratorAggregate
{
    private array $items;

    public function __construct(array $items)
    {
        $this->assertType($items);

        $this->items = $items;
    }

    protected function assertType(array $items): void
    {
        $type = $this->type();
        foreach ($items as $item) {
            if (!$item instanceof $type){
                throw new \InvalidArgumentException();
            }
        }
    }

    abstract protected function type(): string;

    protected function items(): array
    {
        return $this->items;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }
}
