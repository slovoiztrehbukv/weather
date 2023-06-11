<?php

namespace App\Services\Weather\Sources;

use App\Services\Weather\Sources\Adapters\Adapter;
use App\Services\Weather\Sources\Adapters\TestSourceAdapter;

class TestSource extends Source {
    protected static function getBaseURL(): string
    {
        return '';
    }

    public function getAdapter() : Adapter
    {
        return new TestSourceAdapter();
    }

    public static function request(string $endpoint, string $method = 'GET', array $data = []) : ?array
    {
        return [];
    }

    public static function getOneWeekPlaceForecast(string $lat, string $lon) : ?array
    {
        return [];
    }
}
