<?php

namespace App\Services\Weather;

use App\Services\Weather\Sources\Contracts\ICityRequestable;

class WeatherCompositionService {
    public function getCityDatas(string $city)
    {
        $sources = array_filter(config('weather.sources.enabled'), fn($source) => (new $source) instanceof ICityRequestable);

        return array_map(
            function($source) use ($city) {
                return app()->make($source)->getCityData($city);
            },
            $sources
        );
    }
}
