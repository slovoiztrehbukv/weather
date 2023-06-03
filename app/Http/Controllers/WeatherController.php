<?php

namespace App\Http\Controllers;

use App\Services\Weather\Sources\SevenTimer;
use App\Services\Weather\WeatherCompositionService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function city(string $city, WeatherCompositionService $weatherService)
    {
        return response()->json($weatherService->getCityDatas($city));
    }
}
