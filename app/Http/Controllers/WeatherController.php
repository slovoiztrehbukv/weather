<?php

namespace App\Http\Controllers;

use App\Services\Weather\Table\Helper as TableHelper;
use App\Http\Requests\GetWeatherByCoordsRequest;
use App\Services\Weather\WeatherCompositionService;

class WeatherController extends Controller
{

    /**
    * @apiResourceCollection  App\Http\Resources\OneWeekTableRow
    */
    public function oneWeekByCoords(GetWeatherByCoordsRequest $request, WeatherCompositionService $weatherService)
    {
        return $weatherService->getOneWeekPlaceDatas(
            $request->post('lat'),
            $request->post('lon'),
        );
    }

    public function oneWeekTableHeaders()
    {
        return TableHelper::getOneWeekTableHeaders();
    }
}
