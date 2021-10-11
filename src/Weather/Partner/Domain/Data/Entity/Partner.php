<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\Entity;

use App\Weather\Partner\Domain\Data\Collection\Predictions;
use App\Weather\Partner\Domain\Data\ValueObject\Date;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\City;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\Scale;
use App\Weather\Partner\Domain\Filter\FilterPredictionsByCityAndDate;
use App\Weather\Partner\Domain\PartnerFactory;

class Partner
{
    public function __construct(
        private string $id,
        private string $name,
        private ?Predictions $predictions,
    ){}

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getPredictions() : Predictions
    {
        return $this->predictions;
    }

    public function addPrediction(Predictions $prediction)
    {}

    public static function filterPredictionsByCityAndDate(Predictions $predictions, City $city, Date $date) : Predictions
    {
        $filtered = new FilterPredictionsByCityAndDate($city, $date, $predictions->getIterator());

        return PartnerFactory::predictionsFromFilter($filtered);
    }

    public static function createPredictionsFromBbc(\Iterator $iterator) : Predictions
    {
        return PartnerFactory::predictionsFromBbc($iterator);
    }

    public static function createPredictionsFromWeatherCom(\Iterator $iterator) : Predictions
    {
        return PartnerFactory::predictionsFromWeatherCom($iterator);
    }

    public static function createDate(string $date) : Date
    {
        return PartnerFactory::dateFromString($date);
    }

    public static function createCity(string $city) : City
    {
        return PartnerFactory::cityFromString($city);
    }

    public static function createScale(string $city) : Scale
    {
        return PartnerFactory::scaleFromString($city);
    }
}