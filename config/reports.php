<?php

return [
    'auth' => true,
    'uri' => 'raporty',
    'adminIds' => [1],
    'page' => [
        'name' => env('REPORTS_PAGE_NAME', 'Page Name'),
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
            'path' => env('REPORTS_SETTINGS_ASSETS_PATH'),
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
    'css' => [
        'container' => 'container-fluid',
        'col' => 'col col-lg-9 offset-lg-1 col-xl-8 offset-xl-2',
        'wrapper' => 'mt-1 mb-3',
        'chart' => 'border bg-white',
        'table' => 'table table-bordered table-hover bg-white',
    ]
];
