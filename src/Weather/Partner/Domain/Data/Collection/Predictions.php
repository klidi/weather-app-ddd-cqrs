<?php


namespace App\Weather\Partner\Domain\Data\Collection;


use App\Shared\Domain\Collection;
use App\Weather\Partner\Domain\Data\ValueObject\Prediction;

class Predictions extends Collection
{
    protected function type(): string
    {
        return Prediction::class;
    }
}