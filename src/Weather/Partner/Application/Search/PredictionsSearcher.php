<?php

declare(strict_types=1);

namespace App\Weather\Partner\Application\Search;

use App\Shared\Domain\Scale as OutputScale;
use App\Weather\Partner\Domain\Data\Entity\Partner;
use App\Weather\Partner\Infrastructure\Exception\RepositoryException;
use App\Weather\Partner\Infrastructure\Factory\FilePartnerRepositoryFactory;

class PredictionsSearcher
{
    public function __construct() {}

    /**
     * @throws RepositoryException
     */
    public function search(string $city, string $date, string $scale) : array
    {
        // enforce some invariants that are encapsulated inside this objects
        $city = Partner::createCity($city);
        $date = Partner::createDate($date);
        $scale = new OutputScale($scale);

        $partners = array_keys(FilePartnerRepositoryFactory::REPOSITORY_REGISTRY);
        $partnersPredictions = [];

        foreach ($partners as $partner) {
           $repository = FilePartnerRepositoryFactory::makeFromPartnerName($partner);
           $partnersPredictions[] = $repository->searchPredictions($city, $date);
        }

        return $partnersPredictions;
    }
}