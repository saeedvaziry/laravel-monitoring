<?php

namespace SaeedVaziry\Monitoring\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringAlert extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'instance_name',
        'cpu',
        'memory',
        'disk',
        'occurred',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'cpu'      => 'float',
        'memory'   => 'float',
        'disk'     => 'float',
        'occurred' => 'integer',
    ];
}
