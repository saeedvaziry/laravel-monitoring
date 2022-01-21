<?php

namespace SaeedVaziry\Monitoring\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use SaeedVaziry\Monitoring\Models\MonitoringAlert;

class MonitoringAlertFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = MonitoringAlert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'instance_name' => config('monitoring.instance_name'),
            'cpu'           => 40,
            'memory'        => 30,
            'disk'          => 20,
            'occurred'      => 0,
        ];
    }
}
