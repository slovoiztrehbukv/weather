<?php

namespace Tests\Feature\Weather;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeventTimerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_getting_city_data()
    {
        $targetCities = [
            'spb',
            'moscow',
            'ny',
            'dubai',
        ];

        foreach($targetCities as $city) {
            $response = $this->get("/api/weather/{$city}");
            $response->assertOk();
        }
    }
}
