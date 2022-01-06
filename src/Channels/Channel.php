<?php

namespace SaeedVaziry\Monitoring\Channels;

interface Channel
{
    /**
     * @param $record
     * @return void
     */
    public function send($record);
}
