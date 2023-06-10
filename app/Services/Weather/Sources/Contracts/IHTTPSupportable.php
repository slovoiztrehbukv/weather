<?php

namespace App\Services\Weather\Sources\Contracts;

interface IHTTPSupportable {
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data
     * @return array|null
     */
    public static function request(string $method, string $endpoint, array $data = []) : ?array;
}
