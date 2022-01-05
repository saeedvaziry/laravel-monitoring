<?php

namespace SaeedVaziry\Monitoring\System;

class Disk implements SystemResource
{
    /**
     * @return int|mixed
     */
    public function usage()
    {
        $usage = shell_exec(file_get_contents(__DIR__ . '/../../scripts/disk.sh'));
        if (is_numeric($usage)) {
            return $usage;
        }

        return null;
    }
}
