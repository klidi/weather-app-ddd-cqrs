<?php

declare(strict_types=1);

namespace App\Weather\Partner\Application\Search;

use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Weather\Partner\Application\PredictionsResponseConverter;
use App\Weather\Partner\Application\PredictionsResponse;

class SearchPredictionsQueryHandler implements QueryHandler
{
    public function __construct(private PredictionsSearcher $searcher)
    {
    }

    public function __invoke(SearchPredictionsQuery $query) : PredictionsResponse
    {
        $partnersPredictions = $this->searcher->search($query->city(), $query->date(), $query->scale());

        return PredictionsResponseConverter::fromPartners($partnersPredictions, $query->scale());
    }

}