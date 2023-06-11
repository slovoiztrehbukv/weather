<?php

namespace App\Services\Weather\Sources\Adapters;

use App\Http\Resources\OneWeekTableRow;

abstract class Adapter {
    abstract public function getSourceName() : string;

    abstract public function toOneWeekTableRow(array $data = []) : array; // TODO UNTYPED ARRAY -> TO DTO
}
