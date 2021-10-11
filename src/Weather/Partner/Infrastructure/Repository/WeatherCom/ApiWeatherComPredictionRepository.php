<?php


namespace App\Weather\Partner\Infrastructure\Repository\WeatherCom;


use App\Weather\Partner\Domain\Data\Collection\Predictions;
use App\Weather\Partner\Domain\Data\ValueObject\Date;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\City;
use App\Weather\Partner\Domain\PartnerRepository;
use App\Weather\Partner\Infrastructure\Repository\AbstractPartnerRepository;

class ApiWeatherComPredictionRepository extends AbstractPartnerRepository
{
    public function searchPredictions(City $city, Date $date): Predictions
    {
        // TODO: Implement search() method.
    }

    protected function cacheKey(): string
    {
        return "";
    }
}