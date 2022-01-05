<?php

namespace SaeedVaziry\Monitoring\Facades;

use Illuminate\Support\Facades\Facade;
use SaeedVaziry\Monitoring\System\SystemResource;

/**
 * Class Monitoring.
 *
 *
 * @method static SystemResource cpu()
 * @method static SystemResource memory()
 * @method static SystemResource disk()
 */
class Monitoring extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'monitoring';
    }
}
