<?php

declare(strict_types=1);

namespace App\Weather\Partner\Presentation\Http\Controller;

use App\Shared\Infrastructure\Symfony\ApiController;
use App\Weather\Partner\Application\PredictionItemResponse;
use App\Weather\Partner\Application\PredictionResponse;
use App\Weather\Partner\Application\Search\SearchPredictionsQuery;
use App\Weather\Partner\Application\PredictionsResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use function Lambdish\Phunctional\map;

final class PredictionsSearchController extends ApiController
{
    public function __invoke(Request $request) : JsonResponse
    {
        $city = $request->query->get('city');
        $date = $request->query->get('date');
        $scale = $request->query->get('scale');

        /** @var PredictionsResponse $response */
        $response = $this->ask(new SearchPredictionsQuery($city, $date, $scale));

        return new JsonResponse(map(
            fn(PredictionResponse $prediction) => [
                    $prediction->city() => map(fn(PredictionItemResponse $item) => [
                        $item->value(),
                        $item->time(),
                    ], $prediction->items())
                ],
                $response->predictions()
            ),
            200,
            ['Access-Control-Allow-Origin' => '*']);
    }

    protected function exceptions(): array
    {
        return [];
    }
}