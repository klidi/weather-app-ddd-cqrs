<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\ValueObject\Enum;

final class Scale
{
    public const CELSIUS = 'celsius';
    public const FAHRENHEIT = 'fahrenheit';
    public const KELVIN = 'kelvin';

    private const VALUES = [
        self::CELSIUS,
        self::FAHRENHEIT,
        self::KELVIN,
        // Can add more scales
    ];

    private string $value;

    public function __construct(string $value)
    {
        $this->value = strtolower($value);

        if (!\in_array($this->value, self::VALUES)) {
            throw new \InvalidArgumentException("Unsupported Partner Scale");
        }
    }

    public function value() : string
    {
        return $this->value;
    }
}