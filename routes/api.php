<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/cities', [CityController::class, 'list'])->name('cities.chunk');

Route::controller(WeatherController::class)->group(function() {
    Route::post('/weather/one-week', 'oneWeekByCoords')->name('weather.week.rows');
    Route::get('/weather/one-week/headers', 'oneWeekTableHeaders')->name('weather.week.headers');
});