<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\ValueObject\Enum;

final class City
{
    private const VALUES = [
        'Amsterdam',
        'Haarlem'
    ];

    public function __construct(private string $value)
    {
        if (!\in_array(ucfirst($this->value), self::VALUES)) {
            // TODO throw exception
        }
    }

    public function value() : string
    {
        return $this->value;
    }
}