<?php

namespace SaeedVaziry\Monitoring\Channels;

use Illuminate\Support\Facades\Mail;
use SaeedVaziry\Monitoring\Mail\ResourceUsageMail;

class Email extends BaseChannel
{
    /**
     * @param $record
     *
     * @return void
     */
    public function send($record)
    {
        Mail::to(config('monitoring.notifications.email'))->send(new ResourceUsageMail(
            $this->subject($record),
            $record
        ));
    }
}
