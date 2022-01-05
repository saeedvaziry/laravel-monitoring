<?php

namespace SaeedVaziry\Monitoring\System;

use Illuminate\Support\Str;

class Memory implements SystemResource
{
    /**
     * @return int|mixed
     */
    public function usage()
    {
        $usage = Str::replace("\n", '', shell_exec(file_get_contents(__DIR__ . '/../../scripts/memory.sh')));
        if (is_numeric($usage)) {
            return $usage;
        }

        return null;
    }
}
