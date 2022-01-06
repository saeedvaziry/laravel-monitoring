<?php

namespace SaeedVaziry\Monitoring\Tests\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use SaeedVaziry\Monitoring\Channels\Email;
use SaeedVaziry\Monitoring\Mail\ResourceUsageMail;
use SaeedVaziry\Monitoring\Models\MonitoringAlert;
use SaeedVaziry\Monitoring\Tests\TestCase;

class CheckForAlertsTest extends TestCase
{
    use RefreshDatabase;

    public function testAlert()
    {
        Mail::fake();

        config()->set('monitoring.notifications.channels', [Email::class]);
        config()->set('monitoring.notifications.email', 'user@example.com');

        $alert = MonitoringAlert::query()->create([
            'instance_name' => config('monitoring.instance_name'),
            'cpu' => 20,
            'memory' => 40,
            'disk' => 80
        ]);

        // In `testing` environment this will record `50` for all resources
        $this->artisan('monitoring:record');

        $this->assertDatabaseHas('monitoring_alerts', [
            'id' => $alert->id,
            'occurred' => 1
        ]);

        Mail::assertSent(ResourceUsageMail::class);
    }

    public function testNoAlert()
    {
        Mail::fake();

        config()->set('monitoring.notifications.channels', [Email::class]);
        config()->set('monitoring.notifications.email', 'user@example.com');

        $alert = MonitoringAlert::query()->create([
            'instance_name' => config('monitoring.instance_name'),
            'cpu' => 70,
            'memory' => 55,
            'disk' => 90
        ]);

        // In `testing` environment this will record `50` for all resources
        $this->artisan('monitoring:record');

        $this->assertDatabaseHas('monitoring_alerts', [
            'id' => $alert->id,
            'occurred' => 0
        ]);

        Mail::assertNothingSent();
    }
}
