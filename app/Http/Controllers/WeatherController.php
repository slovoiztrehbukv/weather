<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetWeatherByCoordsRequest;
use App\Services\Weather\WeatherCompositionService;

class WeatherController extends Controller
{
    public function byCoords(GetWeatherByCoordsRequest $request, WeatherCompositionService $weatherService)
    {
        // TODO UNMOCK ME
        return [
            '7Timer' => [
                'data' => [
                    '09.06' => [
                        'temp' => 16.9
                    ],
                    '10.06' => [
                        'temp' => 12.4
                    ],
                    '11.06' => [
                        'temp' => 19.1
                    ],
                    '12.06' => [
                        'temp' => -4.0
                    ],
                    '13.06' => [
                        'temp' => -4.0
                    ],
                    '14.06' => [
                        'temp' => -4.0
                    ],
                    '15.06' => [
                        'temp' => -4.2
                    ],
                ],
            ],
            'SecondOne' => [
                'data' => [
                    '09.06' => [
                        'temp' => 16.9
                    ],
                    '10.06' => [
                        'temp' => 12.4
                    ],
                    '11.06' => [
                        'temp' => 19.1
                    ],
                    '12.06' => [
                        'temp' => -4.0
                    ],
                    '13.06' => [
                        'temp' => -4.0
                    ],
                    '14.06' => [
                        'temp' => -4.0
                    ],
                    '15.06' => [
                        'temp' => -4.1
                    ],
                ],
            ],
            'avg' => [
                'data' => [
                    '09.06' => [
                        'temp' => 16.9
                    ],
                    '10.06' => [
                        'temp' => 12.4
                    ],
                    '11.06' => [
                        'temp' => 19.1
                    ],
                    '12.06' => [
                        'temp' => -4.0
                    ],
                    '13.06' => [
                        'temp' => -4.0
                    ],
                    '14.06' => [
                        'temp' => -4.0
                    ],
                    '15.06' => [
                        'temp' => -4.3
                    ],
                ],
            ],
        ];

        return response()->json($weatherService->getCityDatas($request));
    }
}
