<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\ValueObject;

class PredictionItem
{
    public function __construct(
        private Temperature $temperature,
        private Time $time,
    ){}

    public function temperature() : Temperature
    {
        return $this->temperature;
    }

    public function time() : Time
    {
        return $this->time;
    }
}