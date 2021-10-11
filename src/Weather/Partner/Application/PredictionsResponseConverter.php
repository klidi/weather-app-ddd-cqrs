<?php

declare(strict_types=1);

namespace App\Weather\Partner\Application;

use App\Shared\Domain\Scale;
use App\Weather\Partner\Domain\Data\Collection\PredictionItems;
use App\Weather\Partner\Domain\Data\Collection\Predictions;
use App\Weather\Partner\Domain\Data\ValueObject\Prediction;
use App\Weather\Partner\Domain\Data\ValueObject\PredictionItem;

final class PredictionsResponseConverter
{
    /**
     * @throws \Exception
     */
    public static function fromPartners(array $partnersPredictions, string $scale): PredictionsResponse
    {
        $response = new PredictionsResponse();

        foreach ($partnersPredictions as $partnerPredictions) {
            self::iteratePredictions($partnerPredictions, $response, $scale);
        }

        return $response;
    }

    /**
     * @throws \Exception
     */
    private static function iteratePredictions(Predictions $predictions, PredictionsResponse $response, string $scale)
    {
        /** @var Prediction $prediction */
        foreach ($predictions as $prediction) {
            self::iterateItems($prediction->items(), $scale, $response->addPrediction($prediction->city()->value()));
        }
    }

    /**
     * @throws \Exception
     */
    private static function iterateItems(PredictionItems $items, string $scale, PredictionResponse $response)
    {
        /** @var PredictionItem $item */
        foreach ($items as $item) {
            $response->addItem($item->time()->value())->addValue(self::convertTemperature($item, $scale));
        }
    }

    /**
     * @throws \Exception
     */
    private static function convertTemperature(PredictionItem $item, $scale): float
    {
        return $scale == Scale::CELSIUS ? $item->temperature()->celsius() : $item->temperature()->fahrenheit();
    }
}