<?php

declare(strict_types=1);

namespace App\Weather\Partner\Infrastructure\Exception;

class RepositoryException extends \Exception
{
    public static function unableToReadDataFromCsvFile() : self
    {
        return new self("Unable to read data from csv file");
    }

    public static function unableToReadDataFromJsonFile() : self
    {
        return new self("Unable to read data from json file");
    }

    public static function unableToReadDataFromXmlFile() : self
    {
        return new self("Unable to read data from xml file");
    }
}