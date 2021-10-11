<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\ValueObject;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

final class Date extends CarbonImmutable
{
    private const MAX_DAYS_DIFFERENCE = 10;

    public static function parse($time = null, $tz = null): Date
    {
        $date = parent::parse($time);
        self::validate($date);

        return $date;
    }

    public static function validate(CarbonImmutable $date) : void
    {
        $isInPast = Carbon::now()->startOfDay()->gte($date);
        $isToFarInFuture = Carbon::now()->addDays(self::MAX_DAYS_DIFFERENCE)->lt($date);

        if ($isInPast || $isToFarInFuture) {
            throw new \InvalidArgumentException("Date in the past or out of range");
        }
    }
}