<?php

namespace SaeedVaziry\Monitoring;

trait HasAlerts
{
    /**
     * @param array $instances
     *
     * @return array
     */
    public function getAlerts(array $instances)
    {
        $alerts = [];
        foreach ($instances as $instance) {
            $alerts[$instance] = app(config('monitoring.models.monitoring_alert'))
                ->where('instance_name', $instance)
                ->first();
        }

        return $alerts;
    }
}
