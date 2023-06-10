<?php

namespace Tests\Feature\Weather;

use App\Models\City;
use Tests\TestCase;

class MainAppTest extends TestCase
{
    public function test_main_page_ok()
    {
        $this->get('/')->assertOk();
    }

    public function test_404_page_ok()
    {
        $this->get('/nonexistent')->assertNotFound();
    }

    public function test_cities_have_been_seeded()
    {
        $targetCities = [
            'Saint Petersburg', // twice
            'Moscow',
            'Johannesburg'
        ];

        $this->assertEquals(
            City::whereIn('name', $targetCities)->count(),
            4,
        );
    }

    public function test_cities_have_been_found()
    {
        $response = $this->get(route('cities.chunk', ['q' => 'saint petersburg']));
        $response->assertOk();
        $response->assertJsonCount(2);
    }

    public function test_table_headers_ok()
    {
        $response = $this->get(route('weather.week.headers'));
        $response->assertOk();
        $response->assertJsonCount(8);
    }

    public function test_table_rows_bad()
    {
        $response = $this->post(route('weather.week.rows'), ['lat' => 1234, 'lon' => 4321]);
        $response->assertStatus(400);
    }

    public function test_table_rows_good()
    {
        $city = City::firstWhere('name', '=', 'Moscow');

        $response = $this->post(route('weather.week.rows'), ['lat' => $city->latitude, 'lon' => $city->longitude]);
        $response->assertStatus(200);
        $response->assertJsonCount(count(config('weather.sources.enabled')) + 1);
    }
}
