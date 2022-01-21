<?php

namespace SaeedVaziry\Monitoring\Exceptions;

use Exception;

class OSIsNotSupported extends Exception
{
    /**
     * @param $message
     */
    public function __construct($message)
    {
        parent::__construct($message.' is not supported');
    }
}
