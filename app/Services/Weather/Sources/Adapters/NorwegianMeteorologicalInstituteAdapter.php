<?php

namespace App\Services\Weather\Sources\Adapters;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class NorwegianMeteorologicalInstituteAdapter extends Adapter {
    public function getSourceName() : string
    {
        return 'MetNo';
    }

    public function toOneWeekTableRow(array $srcData = []) : array
    {
        $out = [];

        $now = Carbon::now();

        $data = array_map(
            fn ($item) => [
                'date' => explode('T', $item['time'])[0],
                'temp' => $item['data']['instant']['details']['air_temperature'],
            ],
            $srcData['properties']['timeseries']
        );
        $data = new Collection($data);

        for ($i = 0; $i < 7; $i++) {
            $now->addDay();
            $out[$i] = $data->firstWhere('date', '=', $now->format('Y-m-d'))['temp'];
        }

        return [
            'name' => $this->getSourceName(),
            'data' => $out,
        ];
    }
}
