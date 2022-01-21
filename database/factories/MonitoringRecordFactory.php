<?php

namespace SaeedVaziry\Monitoring\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use SaeedVaziry\Monitoring\Models\MonitoringRecord;

class MonitoringRecordFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = MonitoringRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'instance_name' => config('monitoring.instance_name'),
            'cpu'           => 10,
            'memory'        => 20,
            'disk'          => 30,
        ];
    }
}
