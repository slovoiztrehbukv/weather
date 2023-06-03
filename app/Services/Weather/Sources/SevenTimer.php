<?php

namespace App\Services\Weather\Sources;

use App\Services\Weather\Sources\Contracts\ICityRequestable;
use Illuminate\Support\Facades\Http;

class SevenTimer implements ICityRequestable {
    private $baseUrl = 'https://www.7timer.info/bin';



    public function getCityData(string $city) : array {
        $response = Http::get($this->baseUrl . '/astro.php', [
            'lon' => 123,
            'lat' => 321,
            'unit' => 'metric',
            'output' => 'json',
        ]);

        return $response->json();
    }
}
