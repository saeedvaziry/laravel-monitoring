<?php

return [
    /*
     * The monitoring data will be collected under this name.
     * If you have running same source code on multiple servers then
     * you need to define a unique name per instance by using
     * environment variables on each server.
     */
    'instance_name' => env('MONITORING_INSTANCE_NAME', env('APP_NAME')),

    /*
     * Route configurations
     */
    'routes' => [
        'prefix' => 'monitoring',
        'middlewares' => ['web']
    ],

    /*
     * Models
     */
    'models' => [
        'monitoring_record' => \SaeedVaziry\Monitoring\Models\MonitoringRecord::class
    ],

    /*
     * Chart colors
     */
    'chart_colors' => [
        'cpu' => [
            'border_color' => '#4f46e5',
            'background_color' => '#a5b4fc'
        ],
        'memory' => [
            'border_color' => '#e11d48',
            'background_color' => '#fda4af'
        ],
        'disk' => [
            'border_color' => '#9333ea',
            'background_color' => '#d8b4fe'
        ],
    ]
];
