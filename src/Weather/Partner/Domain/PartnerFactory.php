<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain;

use App\Shared\Domain\Collection;
use App\Weather\Partner\Domain\Data\Collection\PredictionItems;
use App\Weather\Partner\Domain\Data\Collection\Predictions;
use App\Weather\Partner\Domain\Data\Entity\Partner;
use App\Weather\Partner\Domain\Data\ValueObject\Date;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\City;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\Scale;
use App\Weather\Partner\Domain\Data\ValueObject\Prediction;
use App\Weather\Partner\Domain\Data\ValueObject\PredictionItem;
use App\Weather\Partner\Domain\Data\ValueObject\Temperature;
use App\Weather\Partner\Domain\Data\ValueObject\Time;
use Carbon\CarbonImmutable;

final class PartnerFactory
{
    public static function fromPersistence(string $id, string $name) : Partner
    {

    }

    public static function predictionsFromFilter(\Iterator $predictionsIterator) : Predictions
    {
        return new Predictions(iterator_to_array($predictionsIterator, true));
    }

    public static function predictionsFromBbc(\Iterator $predictionsData) : Predictions
    {
        $fields = ['prediction__time', 'prediction__value'];

        $predictions = new Predictions([]);
        $predictionItems = new PredictionItems([]);

        $scale = null;
        $city = null;
        $date = null;

        /**
         * I am not sure of the csv structure if we have more then one prediction or more then one city
         */
        foreach ($predictionsData as $data) {
            if (!empty($data['-scale']) && !empty($data['city']) && !empty($data['date'])) {
                if ($predictionItems->count() > 1) {
                    $predictions->append(new Prediction(
                        new Scale($scale),
                        new City($city),
                        Date::parse($date),
                        $predictionItems
                    ));
                }

                $scale = $data['-scale'];
                $city = $data['city'];
                $date = $data['date'];

                $predictionItems = new PredictionItems([]);
            }

            self::validatePredictionData($data, $fields);

            if ($scale && $city && $date) {
                $predictionItems->append(new PredictionItem(
                    new Temperature(new Scale($scale), (float)$data['prediction__value']),
                    new Time($data['prediction__time'])
                ));
            }
        }

        // append the last Prediction
        $predictions->append(new Prediction(
            new Scale($scale),
            new City($city),
            CarbonImmutable::parse($date),
            $predictionItems
        ));

        return $predictions;
    }

    public static function predictionsFromWeatherCom(\Iterator $predictionsData) : Predictions
    {
        $fields = ['-scale', 'city', 'date', 'prediction'];
        $predictions = new Predictions([]);

        foreach ($predictionsData as $predictionData) {
            self::validatePredictionData($predictionData, $fields);
            $predictionItems = new PredictionItems([]);

            foreach ($predictionData['prediction'] as $data) {
                $predictionFields = ['time', 'value'];
                self::validatePredictionData($data, $predictionFields);

                $predictionItems->append(new PredictionItem(
                    new Temperature(new Scale($predictionData['-scale']), (float)$data['value']),
                    new Time($data['time'])
                ));
            }

            $predictions->append(new Prediction(
                new Scale($predictionData['-scale']),
                new City($predictionData['city']),
                CarbonImmutable::parse($predictionData['date']),
                $predictionItems,
            ));
        }

        return $predictions;
    }

    public static function dateFromString(string $date) : Date
    {
        return Date::parse($date);
    }

    public static function cityFromString(string $city) : City
    {
        return new City($city);
    }

    public static function scaleFromString(string $scale) : Scale
    {
        return new Scale($scale);
    }

    private static function validatePredictionData(array $data, array $expected) : void
    {
        $data = array_filter($data, function ($value) {
            return null !== $value && false !== $value && '' !== $value;
        });

        if ($diff = array_diff($expected, array_keys($data))) {
            throw new \InvalidArgumentException(sprintf('Missing or empty field(s): "%s".', implode('", "', $diff)));
        }
    }
}