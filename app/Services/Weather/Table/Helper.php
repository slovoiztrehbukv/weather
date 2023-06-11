<?php

namespace App\Services\Weather\Table;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Helper {
    public static function getOneWeekTableHeaders()
    {
        $out = [];
        $now = Carbon::now();

        $out[] = [
            'label' => '', // 'Service name',
            'key' => 'name',
        ];
        $out[] = [
            'label' => $now->format('d.m'),
        ];

        for ($i = 2; $i <= 7; $i++) {
            $out[] = [
                'label' => $now->addDay()->format('d.m')
            ];
        }

        return $out;
    }

    public static function getOneWeekAvg(array $forecasts = [])
    {
        $total = [];

        foreach ($forecasts as $forecast) {
            foreach ($forecast['data'] as $i => $temp) {
                if (!isset($total[$i])) $total[$i] = 0;

                $total[$i] += $temp;
            }
        }

        return [
            'name' => 'Average',
            'data' => array_map(
                fn ($t) => (float) number_format($t / count($forecasts), 1),
                $total
            ),
        ];
    }

    public static function transformCitiesToDropdownList(Collection $cities)
    {
        return $cities->map(fn($c)=>[
            'value' => $c['latitude'] . '|' . $c['longitude'],
            'label' => $c['name'] . ', ' . $c['country'],
        ]);
    }
}
