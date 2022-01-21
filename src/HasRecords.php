<?php

namespace SaeedVaziry\Monitoring;

use Illuminate\Support\Collection;

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
     *
     * @return array
     */
    protected function getRecords(array $instances)
    {
        $records = [];
        foreach ($instances as $instance) {
            $records[$instance] = app(config('monitoring.models.monitoring_record'))
                ->where('instance_name', $instance)
                ->orderByDesc('id')
                ->take(60)
                ->get();
        }

        return $records;
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

    /**
     * @param Collection $records
     *
     * @return array
     */
    protected function getRecordsChart(Collection $records)
    {
        $labels = [];
        $cpu = [];
        $memory = [];
        $disk = [];
        for ($i = $records->count() - 1; $i >= 0; $i--) {
            $cpu[] = $records[$i]->cpu;
            $memory[] = $records[$i]->memory;
            $disk[] = $records[$i]->disk;
            $labels[] = $records[$i]->created_at;
        }

        return [
            'labels'   => $labels,
            'datasets' => [
                [
                    'label'           => 'CPU',
                    'data'            => $cpu,
                    'borderWidth'     => 1.5,
                    'fill'            => false,
                    'borderColor'     => config('monitoring.chart_colors.cpu.border_color'),
                    'backgroundColor' => config('monitoring.chart_colors.cpu.background_color'),
                ],
                [
                    'label'           => 'Memory',
                    'data'            => $memory,
                    'borderWidth'     => 1.5,
                    'fill'            => false,
                    'borderColor'     => config('monitoring.chart_colors.memory.border_color'),
                    'backgroundColor' => config('monitoring.chart_colors.memory.background_color'),
                ],
                [
                    'label'           => 'Disk',
                    'data'            => $disk,
                    'borderWidth'     => 1.5,
                    'fill'            => false,
                    'borderColor'     => config('monitoring.chart_colors.disk.border_color'),
                    'backgroundColor' => config('monitoring.chart_colors.disk.background_color'),
                ],
            ],
        ];
    }

    /**
     * @param array $records
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function getCharts(array $records)
    {
        $charts = [];
        foreach ($records as $key => $record) {
            $charts[$key] = $this->getRecordsChart($record);
        }

        return $charts;
    }
}
