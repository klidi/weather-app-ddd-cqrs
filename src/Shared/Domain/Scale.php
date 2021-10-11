<?php

declare(strict_types=1);

namespace App\Shared\Domain;

final class Scale
{
    public const CELSIUS = 'celsius';
    public const FAHRENHEIT = 'fahrenheit';

    private const VALUES = [
        self::CELSIUS,
        self::FAHRENHEIT,
        // Can add more scales
    ];

    public function __construct(private string $value)
    {
        if (!\in_array($this->value, self::VALUES)) {
            throw new \InvalidArgumentException("Unsupported scale");
        }
    }

    public function getValue() : string
    {
        return $this->value;
    }
}