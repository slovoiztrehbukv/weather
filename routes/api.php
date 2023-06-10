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

Route::post('/weather/one-week', [WeatherController::class, 'oneWeekByCoords']);
Route::get('/weather/one-week/headers', [WeatherController::class, 'oneWeekTableHeaders']);
Route::get('/cities', [CityController::class, 'list']);
