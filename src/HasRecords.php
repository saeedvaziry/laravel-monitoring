<?php

namespace SaeedVaziry\Monitoring;

trait HasRecords
{
    /**
     * @return mixed
     */
    protected function getInstances()
    {
        $instances = app(config('monitoring.models.monitoring_record'))
            ->groupBy('instance_name')
            ->select('instance_name')
            ->get();
        $result = [];
        foreach ($instances as $instance) {
            $result[] = $instance->instance_name;
        }

        return $result;
    }

    /**
     * @param array $instances
     * @param $duration
     * @return array
     */
    protected function getRecords(array $instances, $duration)
    {
        $records = [];
        foreach ($instances as $instance) {
            $records[$instance] = app(config('monitoring.models.monitoring_record'))
                ->where('instance_name', $instance)
                ->where('created_at', '>', $this->getDurationInTime($duration))
                ->select(['created_at', 'cpu', 'memory', 'disk'])
                ->get()
                ->toArray();
        }

        return $records;
    }

    /**
     * @param string|null $duration
     *
     * @return mixed
     */
    private function getDurationInTime($duration = null)
    {
        return match ($duration) {
            'day' => now()->subDay(),
            default => now()->subHour(),
        };
    }

    /**
     * @param array $instances
     *
     * @return array
     */
    protected function getLastRecords(array $instances)
    {
        $records = [];
        foreach ($instances as $instance) {
            $records[$instance] = app(config('monitoring.models.monitoring_record'))
                ->where('instance_name', $instance)
                ->orderByDesc('id')
                ->first();
        }

        return $records;
    }
}
