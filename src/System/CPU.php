<?php

namespace SaeedVaziry\Monitoring\System;

use Illuminate\Support\Str;

class CPU implements SystemResource
{
    /**
     * @return int|mixed
     */
    public function usage()
    {
        $usage = Str::replace("\n", '', shell_exec(file_get_contents(__DIR__ . '/../../scripts/cpu.sh')));
        if (is_numeric($usage)) {
            return $usage;
        }

        return null;
    }
}
