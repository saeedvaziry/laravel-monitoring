<?php

use Illuminate\Support\Facades\Route;
use SaeedVaziry\Monitoring\Http\MonitoringController;

Route::group([
    'middleware' => config('monitoring.routes.middlewares'),
    'prefix' => config('monitoring.routes.prefix')
], function () {
    Route::get('/', [MonitoringController::class, 'index'])->name('monitoring');
    Route::get('/records', [MonitoringController::class, 'records'])->name('monitoring.records');
});
