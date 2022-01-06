<?php

namespace SaeedVaziry\Monitoring\Tests\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use SaeedVaziry\Monitoring\Actions\CreateAlert;
use SaeedVaziry\Monitoring\Actions\RecordUsage;
use SaeedVaziry\Monitoring\Tests\TestCase;

class CreateAlertTest extends TestCase
{
    use RefreshDatabase;

    public function testSuccessCreate()
    {
        $alert = app(CreateAlert::class)->create([
            'instance_name' => 'some_name',
            'cpu' => 10,
            'memory' => 20,
            'disk' => 30,
        ]);

        $this->assertEquals('some_name', $alert->instance_name);

        $this->assertDatabaseHas('monitoring_alerts', [
            'instance_name' => 'some_name',
            'cpu' => 10,
            'memory' => 20,
            'disk' => 30,
        ]);
    }

    public function testValidationError()
    {
        $this->expectException(ValidationException::class);

        app(CreateAlert::class)->create([
            'instance_name' => 'some_name',
            'cpu' => 111,
            'memory' => 20,
            'disk' => 30,
        ]);
    }

    public function testValidationErrorEmptyPayload()
    {
        $this->expectException(ValidationException::class);

        app(CreateAlert::class)->create([
            'instance_name' => 'some_name',
        ]);
    }
}
