<?php

namespace App\Weather\Partner\Application;

class PredictionResponse
{
    private array $items = [];

    public function __construct(
        private string $city,
    ) {}

    public function addItem($time) : PredictionItemResponse
    {
        return $this->items[$time] ?? $this->items[$time] = new PredictionItemResponse($time);
    }

    public function city() : string
    {
        return $this->city;
    }

    public function items() : array
    {
        return array_values($this->items);
    }
}