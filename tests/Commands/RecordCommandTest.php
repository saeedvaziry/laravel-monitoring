<?php

namespace SaeedVaziry\Monitoring\Tests\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use SaeedVaziry\Monitoring\Tests\TestCase;

class RecordCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testRecord()
    {
        $this->artisan('monitoring:record');

        $this->assertDatabaseHas('monitoring_records', [
            'instance_name' => config('monitoring.instance_name'),
        ]);
    }
}
