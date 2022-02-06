<?php

namespace SaeedVaziry\Monitoring;

use Illuminate\Support\ServiceProvider;
use SaeedVaziry\Monitoring\Commands\PublishCommand;
use SaeedVaziry\Monitoring\Commands\PurgeCommand;
use SaeedVaziry\Monitoring\Commands\RecordCommand;

class MonitoringServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // facade
        $this->app->bind('monitoring', function () {
            return new Monitoring();
        });

        // merge config file
        $this->mergeConfigFrom(__DIR__ . '/../config/monitoring.php', 'monitoring');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrations();
        $this->registerViews();
        $this->registerRoute();
        $this->registerCommands();
        $this->registerPublishing();
    }

    /**
     * Register publishing
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            // publish config
            $this->publishes([
                __DIR__ . '/../config/monitoring.php' => config_path('monitoring.php')
            ], ['monitoring-config', 'laravel-config']);

            // publish migrations
            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations')
            ], ['monitoring-migrations', 'laravel-migrations']);

            // publish assets
            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/monitoring'),
            ], ['monitoring-assets', 'laravel-assets']);
        }
    }

    /**
     * Register commands
     *
     * @return void
     */
    private function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                RecordCommand::class,
                PurgeCommand::class,
                PublishCommand::class,
            ]);
        }
    }

    /**
     * Register routes
     *
     * @return void
     */
    private function registerRoute()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    /**
     * Register views
     *
     * @return void
     */
    private function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'monitoring');
    }

    /**
     * Load migrations
     *
     * @return void
     */
    private function loadMigrations()
    {
        if (config('monitoring.migrations', true) && $this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations/');
        }
    }
}
