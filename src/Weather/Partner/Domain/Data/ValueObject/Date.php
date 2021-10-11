<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\ValueObject;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

final class Date extends \Carbon\CarbonImmutable
{
    private const START_END_MAX_DAYS_DIFFERENCE = 10;

    public function __construct($time = null, $tz = null)
    {
        $this->validate();
        parent::__construct($time, $tz);
    }

    private function validate() : void
    {
        $isInPast = Carbon::now()->startOfDay()->gte($this);
        $isToFar = Carbon::now()->addDays(self::START_END_MAX_DAYS_DIFFERENCE)->lt($this);

        if ($isInPast || $isToFar) {
            // @TODO throw exception
        }
    }
}