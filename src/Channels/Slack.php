<?php

namespace SaeedVaziry\Monitoring\Channels;

use Illuminate\Support\Facades\Http;

class Slack extends BaseChannel
{
    /**
     * @param $record
     *
     * @return void
     */
    public function send($record)
    {
        Http::post(config('monitoring.notifications.slack_webhook_url'), [
            'text' => '*'.$this->subject($record).'*'."\n".$this->message($record),
        ]);
    }
}
