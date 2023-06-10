<?php

namespace App\Services\Weather\Sources\Contracts;

interface IByCoordsRequestable {
    /**
     * @param string $lat
     * @param string $lot
     * @return array|null
     */
    public static function getOneWeekPlaceForecast(string $lat, string $lon) : ?array;
}
