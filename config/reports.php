<?php

return [
    'auth' => true,
    'uri' => 'raporty',
    'adminIds' => [1],
    'page' => [
        'name' => 'MotoLiczby',
        'title' => 'Tytuł',
        'desc' => 'Opis',
    ],
    'settings' => [
        'dataSources' => [
            'elo' => [
                'class' => '\koolreport\laravel\Eloquent',
            ],
        ],
        'assets' => [
            'path' => env('REPORT_SETTINGS_ASSETS_PATH'),
        ],
    ],
    'cacheSettings' => [
        'ttl' => 3600,
    ],
    'colorScheme' => [
        '#3490dc',
        '#e3342f',
        '#38c172'
    ],
    'columnChart' => [
        'count' => 10,
        'height' => '400px',
    ],
    'cssClass' => [
        'container' => 'container-fluid',
        'wrapper' => '',
        'table' => 'table table-bordered table-hover bg-white',
        'chart' => '',
    ]
];
