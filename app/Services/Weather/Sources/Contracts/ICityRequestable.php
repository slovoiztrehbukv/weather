<?php

namespace App\Services\Weather\Sources\Contracts;

interface ICityRequestable {
    public function getCityData (string $city) : ?array;
}
