<?php

return [
    'exchangeratesapi' => [
        'key' => env('EXCHANGERATESAPI_KEY'),
    ],
    'baseCurrency' => 'EUR',
    'commission' => [
        'EU'        => 0.01,
        'default'   => 0.02,
    ],
];