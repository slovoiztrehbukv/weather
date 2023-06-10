<?php

namespace App\Services\Weather\Sources\Adapters;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use RuntimeException;

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
            $srcData['properties']['timeseries'] ?? []
        );

        if (!$data) throw new RuntimeException("There is no data for " . json_encode($srcData));

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
