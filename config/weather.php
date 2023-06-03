<?php

use App\Services\Weather\Sources\SevenTimer;

return [
    'sources' => [
        'enabled' => [
            '7Timer' => SevenTimer::class,
        ]
    ]
];
