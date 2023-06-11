<?php

namespace App\Services\Weather\Sources;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

abstract class Source implements
    Contracts\IAdaptable,
    Contracts\IByCoordsRequestable,
    Contracts\IHTTPSupportable
{
    /**
     * @return string
     */
    abstract protected static function getBaseURL() : string;

    public static function request(string $endpoint, string $method = 'GET', array $data = []) : ?array
    {
        $url = static::getBaseURL() . "/$endpoint";

        try {
            return Http::withUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 YaBrowser/23.5.1.714 Yowser/2.5 Safari/537.36')
                ->{strtolower($method)}($url,$data)
                ->json();
        } catch (\Throwable $e) {
            Log::warning(static::class . "::request($url, $method, " . json_encode($data) . ") FAILED :" . $e->getMessage());
            throw $e;
        }
    }
}
