<?php

namespace SaeedVaziry\Monitoring\Channels;

abstract class BaseChannel implements Channel
{
    /**
     * @return string
     */
    protected function subject($record)
    {
        return __("Resource usage for :instance", ['instance' => $record->instance_name]);
    }

    /**
     * @param $record
     * @return string
     */
    protected function message($record)
    {
        return __("CPU: :cpu\n Memory: :memory\n Disk: :disk", [
            'cpu' => $record->cpu,
            'memory' => $record->memory,
            'disk' => $record->disk,
        ]);
    }
}
