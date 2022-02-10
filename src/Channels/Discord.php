<?php

namespace SaeedVaziry\Monitoring\Channels;

use Illuminate\Support\Facades\Http;

class Discord extends BaseChannel
{
    /**
     * @param $record
     *
     * @return void
     */
    public function send($record)
    {
        Http::post(config('monitoring.notifications.discord_webhook_url'), [
            'content' => '*'.$this->subject($record).'*'."\n".$this->message($record),
        ]);
    }
}
