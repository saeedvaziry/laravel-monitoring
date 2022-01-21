<?php

namespace SaeedVaziry\Monitoring\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringRecord extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'instance_name',
        'cpu',
        'memory',
        'disk',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'cpu'    => 'float',
        'memory' => 'float',
        'disk'   => 'float',
    ];
}
