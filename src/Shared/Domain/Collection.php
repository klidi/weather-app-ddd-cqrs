<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class Collection extends \ArrayObject
{
    public function __construct(array $items)
    {
        Assert::arrayOf($this->type(), $items);
        parent::__construct($items);
    }

    public function append($value)
    {
        Assert::instanceOf($this->type(), $value);
        parent::append($value);
    }
}
