<?php

namespace App\Services\Weather\Sources\Adapters;

class TestSourceAdapter extends Adapter {
    public function getSourceName() : string
    {
        return 'Test service';
    }

    public function toOneWeekTableRow(array $srcData = []) : array
    {
        return [
            'name' => $this->getSourceName(),
            'data' => [10,20,30,40,50,60,70],
        ];
    }
}
