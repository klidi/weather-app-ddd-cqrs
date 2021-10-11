<?php

declare(strict_types=1);

namespace App\Weather\Partner\Infrastructure\Repository\WeatherCom;

use App\Weather\Partner\Domain\Data\Collection\Predictions;
use App\Weather\Partner\Domain\Data\Entity\Partner;
use App\Weather\Partner\Domain\Data\ValueObject\Enum\City;
use App\Weather\Partner\Domain\Data\ValueObject\Date;
use App\Weather\Partner\Infrastructure\Repository\AbstractFilePartnerRepository;
use App\Weather\Partner\Infrastructure\Repository\FileReader\CsvReaderTrait;
use App\Weather\Partner\Infrastructure\Repository\FileReader\JsonReaderTrait;
use League\Csv\Exception;
use Psr\Cache\InvalidArgumentException;

final class FileWeatherComPartnerRepository extends AbstractFilePartnerRepository
{
    use JsonReaderTrait;

    private string $cacheKey = 'weathercom.predictions';
    private string $filePath = __DIR__ . '/../temps.json';

    /**
     * @throws InvalidArgumentException
     */
    public function searchPredictions(City $city, Date $date): Predictions
    {
       $predictions = Partner::createPredictionsFromWeatherCom($this->getRawPredictions());

       return Partner::filterPredictionsByCityAndDate($predictions, $city, $date);
    }

    protected function cacheKey() : string
    {
        return $this->cacheKey;
    }

    protected function filePath(): string
    {
        return $this->filePath;
    }
}