<?php

namespace App\Services\Weather;

use App\Http\Resources\OneWeekTableRow;
use App\Services\Weather\Sources\Contracts\IAdaptable;
use App\Services\Weather\Sources\Contracts\IByCoordsRequestable;
use App\Services\Weather\Table\Helper as TableHelper;

class WeatherCompositionService {
    public function getOneWeekPlaceDatas(string $lat, string $lon, bool $withAvg = true)
    {
        $sources = array_filter(
            config('weather.sources.enabled'),
            function($className) {
                $instance = new $className;

                if (!$instance instanceof IByCoordsRequestable || !$instance instanceof IAdaptable) return false;

                return true;
            }
        );

        $forecasts = array_map(
            function($className) use ($lat, $lon) {
                /**
                * @var Source $source
                 */
                $source = app()->make($className);

                return $source
                    ->getAdapter()
                    ->toOneWeekTableRow(
                        $source->getOneWeekPlaceForecast($lat, $lon) ?? []
                    );
            },
            $sources
        );

        return OneWeekTableRow::collection([
            ...$forecasts,
            TableHelper::getOneWeekAvg($forecasts)
        ]);
    }
}
