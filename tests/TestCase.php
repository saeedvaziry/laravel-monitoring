<?php

namespace SaeedVaziry\Monitoring\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array|string[]
     */
    protected function getPackageProviders($app)
    {
        return ['SaeedVaziry\Monitoring\MonitoringServiceProvider'];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array|string[]
     */
    protected function getPackageAliases($app)
    {
        return [
            'Monitoring' => 'SaeedVaziry\Monitoring\Facades\Monitoring',
        ];
    }
}
