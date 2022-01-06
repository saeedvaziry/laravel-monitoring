<?php

namespace SaeedVaziry\Monitoring\Tests\Channels;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use SaeedVaziry\Monitoring\Channels\Email;
use SaeedVaziry\Monitoring\Database\Factories\MonitoringRecordFactory;
use SaeedVaziry\Monitoring\Mail\ResourceUsageMail;
use SaeedVaziry\Monitoring\Tests\TestCase;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    public function testSendEmail()
    {
        config()->set('monitoring.notifications.channels', [Email::class]);

        Mail::fake();

        app(Email::class)->send(MonitoringRecordFactory::new()->create());

        Mail::assertSent(ResourceUsageMail::class);
    }
}
