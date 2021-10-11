<?php

namespace App\Weather\Partner\Domain;

use App\Weather\Partner\Domain\Data\Collection\Predictions;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\City;
use App\Weather\Partner\Domain\Data\ValueObject\Date;
use App\Weather\Partner\Infrastructure\Exception\RepositoryException;

interface PartnerRepository
{
    /**
     * @throws RepositoryException
     */
    public function searchPredictions(City $city, Date $date) : Predictions;
}