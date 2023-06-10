<?php

namespace App\Services\Weather\Sources;

use App\Services\Weather\Sources\Adapters\Adapter;
use App\Services\Weather\Sources\Adapters\NorwegianMeteorologicalInstituteAdapter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NorwegianMeteorologicalInstitute extends Source {
    protected static function getBaseURL(): string
    {
        return 'https://api.met.no/weatherapi/locationforecast/2.0';
    }

    public function getAdapter() : Adapter
    {
        return new NorwegianMeteorologicalInstituteAdapter();
    }

    public static function request(string $endpoint, string $method = 'GET', array $data = []) : ?array
    {
        $url = self::getBaseURL() . "/$endpoint";

        try {
            return Http::withUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 YaBrowser/23.5.1.714 Yowser/2.5 Safari/537.36')
                ->{strtolower($method)}($url,$data)
                ->json();
        } catch (\Throwable $e) {
            Log::warning("NorwegianMeteorologicalInstitute::request($url, $method, " . json_encode($data) . ") FAILED :" . $e->getMessage());
            throw $e;
        }
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
