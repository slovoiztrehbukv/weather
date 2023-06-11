<?php

namespace App\Services\Weather\Sources\Adapters;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use RuntimeException;

class OpenMeteoAdapter extends Adapter {
    public function getSourceName() : string
    {
        return 'Open-Meteo';
    }

    public function toOneWeekTableRow(array $srcData = []) : array
    {
        $out = [];

        foreach($srcData['daily']['time'] as $index => $date) {
            $out[$index] = (float) number_format(($srcData['daily']['temperature_2m_min'][$index] + $srcData['daily']['temperature_2m_max'][$index]) / 2, 1);
        }

        return [
            'name' => $this->getSourceName(),
            'data' => $out,
        ];
    }
}
