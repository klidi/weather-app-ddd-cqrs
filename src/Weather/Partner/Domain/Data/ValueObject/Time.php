<?php

declare(strict_types=1);

namespace App\Weather\Partner\Domain\Data\ValueObject;

final class Time
{
    private const PATTERN = '/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/';

    public function __construct(private string $value)
    {
        if (!$this->validate()) {
            throw new \InvalidArgumentException("Value is not a valid time");
        }
    }

    public function value() : string
    {
        return $this->value;
    }

    private function validate() : bool
    {
        return (bool)preg_match(self::PATTERN, $this->value);
    }
}