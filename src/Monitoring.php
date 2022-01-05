<?php

namespace SaeedVaziry\Monitoring;

use SaeedVaziry\Monitoring\System\CPU;
use SaeedVaziry\Monitoring\System\Disk;
use SaeedVaziry\Monitoring\System\Memory;
use SaeedVaziry\Monitoring\System\SystemResource;

class Monitoring
{
    /**
     * @return SystemResource
     */
    public function cpu()
    {
        return new CPU();
    }

    /**
     * @return SystemResource
     */
    public function memory()
    {
        return new Memory();
    }

    /**
     * @return SystemResource
     */
    public function disk()
    {
        return new Disk();
    }
}
