<?php

namespace SaeedVaziry\Monitoring\Tests\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use SaeedVaziry\Monitoring\Database\Factories\MonitoringRecordFactory;
use SaeedVaziry\Monitoring\Tests\TestCase;

class PurgeCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testPurge()
    {
        config()->set('monitoring.purge_before', '-1 day');

        MonitoringRecordFactory::times(10)->create([
            'created_at' => now()->subDays(10)
        ]);

        $this->artisan('monitoring:purge');

        $this->assertDatabaseCount('monitoring_records', 0);
    }

    public function testPurgeLastHour()
    {
        config()->set('monitoring.purge_before', '-1 hour');

        MonitoringRecordFactory::times(10)->create([
            'created_at' => now()->subMinutes(10)
        ]);

        MonitoringRecordFactory::times(10)->create([
            'created_at' => now()->subDays(10)
        ]);

        $this->artisan('monitoring:purge');

        $this->assertDatabaseCount('monitoring_records', 10);
    }
}
