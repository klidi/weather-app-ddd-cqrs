<?php

declare(strict_types=1);

namespace App\Weather\Partner\Infrastructure\Repository\Bbc;

use App\Weather\Partner\Domain\Data\Collection\Predictions;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\City;
use App\Weather\Partner\Domain\Data\ValueObject\Date;
use App\Weather\Partner\Domain\PartnerRepository;

/**
 *  I would have used this in case we had to consume a real external api.
 */
final class ApiBbcPartnerRepository implements PartnerRepository
{
    public function searchPredictions(City $city, Date $date): Predictions
    {
        // TODO: Implement findByCityAndDate() method.
    }
}