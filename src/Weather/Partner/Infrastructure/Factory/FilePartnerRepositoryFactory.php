<?php

namespace App\Weather\Partner\Infrastructure\Factory;

use App\Weather\Partner\Domain\PartnerRepository;
use App\Weather\Partner\Infrastructure\Repository\Bbc\FileBbcPartnerRepository;
use App\Weather\Partner\Infrastructure\Repository\WeatherCom\FileWeatherComPartnerRepository;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class FilePartnerRepositoryFactory
{
    // just a quick workaround
    public const REPOSITORY_REGISTRY = [
        'weathercom' => FileWeatherComPartnerRepository::class,
        'bbc' => FileBbcPartnerRepository::class,
    ];

    public static function makeFromPartnerName(string $partnerName): PartnerRepository
    {
        if (!isset(self::REPOSITORY_REGISTRY[$partnerName])) {
            throw new \InvalidArgumentException('unknown partner name');
        }

        $className = self::REPOSITORY_REGISTRY[$partnerName];

        return new $className(new FilesystemAdapter());
    }
}