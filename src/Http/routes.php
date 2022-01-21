<?php

use Illuminate\Support\Facades\Route;
use SaeedVaziry\Monitoring\Http\MonitoringAlertController;
use SaeedVaziry\Monitoring\Http\MonitoringController;
use SaeedVaziry\Monitoring\Http\MonitoringRecordController;

Route::group([
    'middleware' => config('monitoring.routes.middlewares'),
    'prefix'     => config('monitoring.routes.prefix'),
], function () {
    Route::get('/', [MonitoringController::class, 'index'])->name('monitoring');
    Route::get('/records', [MonitoringRecordController::class, 'records'])->name('records');
    Route::resource('alerts', MonitoringAlertController::class)->only([
        'store', 'destroy',
    ]);
});
