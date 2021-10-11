<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\ValueObject;

use App\Weather\Partner\Domain\Data\ValueObject\Enum\Scale;

class Temperature
{
    public function __construct(
        private Scale $scale,
        private float $value,
    ){}

    /**
     * @throws \Exception
     */
    public function celsius() : float
    {
        return match ($this->scale->value()) {
            'fahrenheit' => $this->fahrenheitToCelsius(),
            'kelvin' => $this->kelvinToCelsius(),
            'celsius' => $this->value,
            default => throw new \Exception('unsupported scale')
        };
    }

    /**
     * @throws \Exception
     */
    public function fahrenheit() : float
    {
        return match ($this->scale->value()) {
            'celsius' => $this->celsiusToFahrenheit(),
            'kelvin' => $this->kelvinToFahrenheit(),
            'fahrenheit' => $this->value,
            default => throw new \Exception('unsupported scale')
        };
    }

    private function fahrenheitToCelsius() : float
    {
        return 5 / 9 * ($this->value - 32);
    }

    private function kelvinToCelsius() : float
    {
        return $this->value - 273.15;
    }

    private function celsiusToFahrenheit() : float
    {
        return $this->value * 9 / 5 + 32;
    }

    private function kelvinToFahrenheit() : float
    {
        return 9 / 5 * ($this->value - 273.15) + 32;
    }
}