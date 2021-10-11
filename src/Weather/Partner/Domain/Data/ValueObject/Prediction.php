<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\ValueObject;

use App\Weather\Partner\Domain\Data\Collection\PredictionItems;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\City;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\Scale;
use Carbon\CarbonImmutable;

final class Prediction
{
    public function __construct(
        private Scale $scale,
        private City $city,
        private CarbonImmutable $date,
        private PredictionItems $items,
    ){}

    public function scale() : Scale
    {
        return $this->scale;
    }

    public function city() : City
    {
        return $this->city;
    }

    public function date() : CarbonImmutable
    {
        return $this->date;
    }

    public function items() : PredictionItems
    {
        return $this->items;
    }
}