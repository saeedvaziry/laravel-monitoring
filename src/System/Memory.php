<?php

namespace SaeedVaziry\Monitoring\System;

use Illuminate\Support\Str;

class Memory implements SystemResource
{
    /**
     * @return float|mixed
     */
    public function usage()
    {
        if (app()->environment() === 'testing') {
            return 50;
        }

        $usage = Str::replace("\n", '', shell_exec(file_get_contents(__DIR__ . '/../../scripts/memory.sh')));
        if (is_numeric($usage)) {
            return $usage;
        }

        return null;
    }
}
