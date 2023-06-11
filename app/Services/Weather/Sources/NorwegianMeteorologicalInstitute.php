<?php

namespace App\Services\Weather\Sources;

use App\Services\Weather\Sources\Adapters\Adapter;
use App\Services\Weather\Sources\Adapters\NorwegianMeteorologicalInstituteAdapter;

class NorwegianMeteorologicalInstitute extends Source {
    protected static function getBaseURL(): string
    {
        return 'https://api.met.no/weatherapi/locationforecast/2.0';
    }

    public function getAdapter() : Adapter
    {
        return new NorwegianMeteorologicalInstituteAdapter();
    }

    public static function getOneWeekPlaceForecast(string $lat, string $lon) : ?array
    {
        return self::request(
            'compact',
            'GET',
            [
                'lat' => $lat,
                'lon' => $lon,
            ]
        );
    }
}
