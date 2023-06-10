<?php

use App\Services\Weather\Sources\TestSource;
use App\Services\Weather\Sources\NorwegianMeteorologicalInstitute;

return [
    'sources' => [
        'enabled' => [
            NorwegianMeteorologicalInstitute::class,
            // TestSource::class,
        ]
    ]
];
