<?php

declare(strict_types=1);

namespace App\Weather\Partner\Application;

use App\Shared\Domain\Bus\Query\Response;

class PredictionsResponse implements Response
{
    private array $predictions;

    public function predictions() : array
    {
        return array_values($this->predictions);
    }

    public function addPrediction(string $city) : PredictionResponse
    {
        return $this->predictions[$city] ?? $this->predictions[$city] = new PredictionResponse($city);
    }
}