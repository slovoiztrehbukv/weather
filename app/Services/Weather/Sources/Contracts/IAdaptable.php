<?php

namespace App\Services\Weather\Sources\Contracts;

use App\Services\Weather\Sources\Adapters\Adapter;

interface IAdaptable {
    public function getAdapter() : Adapter;
}
