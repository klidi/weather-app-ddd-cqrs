<?php


namespace App\Weather\Partner\Domain\Filter;


use App\Weather\Partner\Domain\Data\ValueObject\Date;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\City;
use App\Weather\Partner\Domain\Data\ValueObject\Prediction;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class FilterPredictionsByCityAndDate extends \FilterIterator
{
    public function __construct(
        private City $city,
        private Date $date,
        \Iterator $iterator,
    ) {
        parent::__construct($iterator);
    }

    public function accept() : bool
    {
        /** @var Prediction $prediction */
        $prediction = $this->getInnerIterator()->current();

        if ($prediction->city()->value() === $this->city->value() &&
            $prediction->date()->toDateString() === $this->date->toDateString()) {
            return true;
        }

        return false;
    }
}