<?php

namespace SaeedVaziry\Monitoring\Tests\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use SaeedVaziry\Monitoring\Tests\TestCase;

class MonitoringAlertControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateAlert()
    {
        $this->post(config('monitoring.routes.prefix').'/alerts', [
            'instance_name' => config('monitoring.instance_name'),
            'cpu'           => 20,
        ])->assertStatus(200);

        $this->assertDatabaseHas('monitoring_alerts', [
            'instance_name' => config('monitoring.instance_name'),
            'cpu'           => 20,
        ]);
    }
}
