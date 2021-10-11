<?php

declare(strict_types=1);

namespace App\Weather\Partner\Application;

final class PredictionItemResponse
{
    private array $values;

    public function __construct(
        private string $time,
    ){}

    public function addValue(float $value) : void
    {
        $this->values[] = $value;
    }

    public function value() : float
    {
        return (float)number_format(array_sum($this->values) / count($this->values), 1, '.');
    }

    public function time() : string
    {
        return $this->time;
    }
}