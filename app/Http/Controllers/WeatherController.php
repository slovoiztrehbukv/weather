<?php

namespace App\Http\Controllers;

use App\Services\Weather\Table\Helper as TableHelper;
use App\Http\Requests\GetWeatherByCoordsRequest;
use App\Services\Weather\WeatherCompositionService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class WeatherController extends Controller
{

    /**
    * @apiResourceCollection  App\Http\Resources\OneWeekTableRow
    */
    public function oneWeekByCoords(GetWeatherByCoordsRequest $request, WeatherCompositionService $weatherService)
    {
        try {
            return $weatherService->getOneWeekPlaceDatas(
                $request->post('lat'),
                $request->post('lon'),
            );
        } catch (\Throwable $e) {
            return response($e->getMessage(), 400);
        }
    }

    public function oneWeekTableHeaders()
    {
        return TableHelper::getOneWeekTableHeaders();
    }
}
