<?php

namespace App\Services\Weather\Sources;

use App\Services\Weather\Sources\Adapters\Adapter;
use App\Services\Weather\Sources\Adapters\OpenMeteoAdapter;

/**
* Only 10k requests at free license available
*/
class OpenMeteo extends Source {

    protected static function getBaseURL(): string
    {
        return 'https://api.open-meteo.com/v1';
    }

    public function getAdapter() : Adapter
    {
        return new OpenMeteoAdapter();
    }

    public static function getOneWeekPlaceForecast(string $lat, string $lon) : ?array
    {
        return self::request(
            'forecast',
            'GET',
            [
                'latitude' => $lat,
                'longitude' => $lon,
                'daily' => 'temperature_2m_max,temperature_2m_min',
                'current_weather' => 'true',
                'current_weather' => 'true',
                'timezone' => 'Europe/Moscow',
            ]
        );
    }
}
