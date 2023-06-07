<?php

namespace App\Http\Controllers;

use App\Services\Weather\Sources\SevenTimer;
use App\Services\Weather\WeatherCompositionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function city(string $city, WeatherCompositionService $weatherService)
    {
        return response()->json($weatherService->getCityDatas($city));
    }

    public function cities(Request $request)
    {
        $q = $request->get('q') ?? '';
        $cities = \App\Models\City::where('city', 'ILIKE', "%$q%")
            ->take(6)
            ->get();

        return $this->transformCitiesToDropdownList($cities);
    }

    private function transformCitiesToDropdownList(Collection $cities) // TODO TO HELPER SERVICE
    {
        return $cities->map(fn($c)=>[
            'value' => $c['latitude'] . '|' . $c['longitude'],
            'label' => $c['city'],
        ]);
    }
}
