<?php

use App\Services\Weather\Sources\OpenMeteo;
use App\Services\Weather\Sources\NorwegianMeteorologicalInstitute;

return [
    'sources' => [
        'enabled' => [
            NorwegianMeteorologicalInstitute::class,
            OpenMeteo::class,
        ]
    ]
];
