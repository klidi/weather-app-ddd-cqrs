<?php

declare(strict_types=1);

namespace App\Weather\Partner\Infrastructure\Repository\FileReader;

use League\Csv\Exception;
use League\Csv\Reader;

// I am not doing anything fancy here, just quick reusable solution across multiple providers repositories to read the csv files
trait CsvReaderTrait
{
    /**
     * @throws Exception
     */
    protected function read(string $path): \Iterator
    {
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        return $csv->getRecords();
    }
}