<?php

namespace SaeedVaziry\Monitoring\Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use SaeedVaziry\Monitoring\Database\Factories\MonitoringAlertFactory;
use SaeedVaziry\Monitoring\Database\Factories\MonitoringRecordFactory;
use SaeedVaziry\Monitoring\Tests\TestCase;

class MonitoringRecordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetRecords()
    {
        MonitoringRecordFactory::times(10)->create();
        MonitoringAlertFactory::new()->create();

        $this->get(config('monitoring.routes.prefix').'/records')->assertJsonStructure([
            'instances',
            'records',
            'alerts',
            'charts',
        ]);
    }
}
