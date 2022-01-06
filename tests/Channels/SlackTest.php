<?php

namespace SaeedVaziry\Monitoring\Tests\Channels;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use SaeedVaziry\Monitoring\Channels\Slack;
use SaeedVaziry\Monitoring\Database\Factories\MonitoringRecordFactory;
use SaeedVaziry\Monitoring\Tests\TestCase;

class SlackTest extends TestCase
{
    use RefreshDatabase;

    public function testSendEmail()
    {
        config()->set('monitoring.notifications.channels', [Slack::class]);
        config()->set('monitoring.notifications.slack_webhook_url', 'http://webhook');

        Http::fake();

        app(Slack::class)->send(MonitoringRecordFactory::new()->create());

        Http::assertSent(function (Request $request) {
            return $request->url() == 'http://webhook';
        });
    }
}
