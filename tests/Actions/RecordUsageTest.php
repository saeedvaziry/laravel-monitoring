<?php

namespace SaeedVaziry\Monitoring\Tests\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use SaeedVaziry\Monitoring\Actions\RecordUsage;
use SaeedVaziry\Monitoring\Tests\TestCase;

class RecordUsageTest extends TestCase
{
    use RefreshDatabase;
    
    public function testRecord()
    {
        config()->set('monitoring.instance_name', 'some_name');

        $record = app(RecordUsage::class)->record([
            'cpu' => 10,
            'memory' => 20,
            'disk' => 30,
        ]);

        $this->assertEquals('some_name', $record->instance_name);
    }
}
