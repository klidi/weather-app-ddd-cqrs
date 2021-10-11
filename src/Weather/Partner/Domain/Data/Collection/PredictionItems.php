<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\Collection;

use App\Shared\Domain\Collection;
use App\Weather\Partner\Domain\Data\ValueObject\PredictionItem;

class PredictionItems extends Collection
{
    protected function type(): string
    {
        return PredictionItem::class;
    }
}