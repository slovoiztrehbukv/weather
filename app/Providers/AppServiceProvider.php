<?php

namespace App\Providers;

use App\Services\Weather\Sources\SevenTimer;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();

        $weatherSources = [
            SevenTimer::class,
        ];

        foreach($weatherSources as $source) {
            $this->app->singleton($source, function () use ($source) {
                return new $source;
            });
        }
    }
}
