<?php

namespace PhpClassFuzz\Exception;

use Exception;

class PhpErrorException extends Exception
{
    public function __construct($errno, $errstr, $errfile, $errline)
    {
        $data = [
            'level' => $errno,
            'message' => $errstr,
            'file' => $errfile,
            'line' => $errline,
        ];

        parent::__construct(print_r($data, 1));
    }
}
