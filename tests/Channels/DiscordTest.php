<?php

namespace SaeedVaziry\Monitoring\Tests\Channels;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use SaeedVaziry\Monitoring\Channels\Discord;
use SaeedVaziry\Monitoring\Database\Factories\MonitoringRecordFactory;
use SaeedVaziry\Monitoring\Tests\TestCase;

class DiscordTest extends TestCase
{
    use RefreshDatabase;

    public function testSendDiscordMessage()
    {
        config()->set('monitoring.notifications.channels', [Discord::class]);
        config()->set('monitoring.notifications.discord_webhook_url', 'http://webhook');

        Http::fake();

        app(Discord::class)->send(MonitoringRecordFactory::new()->create());

        Http::assertSent(function (Request $request) {
            return $request->url() == 'http://webhook';
        });
    }
}
