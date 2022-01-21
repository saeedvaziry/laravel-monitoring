<?php

namespace SaeedVaziry\Monitoring\Actions;

use SaeedVaziry\Monitoring\Exceptions\OSIsNotSupported;
use SaeedVaziry\Monitoring\Models\MonitoringRecord;

class RecordUsage
{
    /**
     * @param array $resources
     *
     * @throws \Exception
     *
     * @return MonitoringRecord
     */
    public function record(array $resources)
    {
        $this->checkOS();

        $model = config('monitoring.models.monitoring_record');
        $record = new $model([
            'instance_name' => str_replace(' ', '', config('monitoring.instance_name')),
            'cpu'           => $resources['cpu'] ?? null,
            'memory'        => $resources['memory'] ?? null,
            'disk'          => $resources['disk'] ?? null,
        ]);
        $record->save();

        return $record;
    }

    /**
     * @throws \Exception
     *
     * @return void
     */
    protected function checkOS()
    {
        if (PHP_OS !== 'Linux' && app()->environment() !== 'testing') {
            throw new OSIsNotSupported(PHP_OS);
        }
    }
}
