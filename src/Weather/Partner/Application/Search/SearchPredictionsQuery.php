<?php

declare(strict_types=1);

namespace App\Weather\Partner\Application\Search;

use App\Shared\Domain\Bus\Query\Query;

class SearchPredictionsQuery implements Query
{
    public function __construct(
        private string $city,
        private string $date,
        private string $scale,
    ) {}

    public function city() : string
    {
        return $this->city;
    }

    public function date() : string
    {
        return $this->date;
    }

    public function scale() : string
    {
        return $this->scale;
    }
}