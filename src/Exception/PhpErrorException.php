<?php

namespace PhpClassFuzz\Exception;

class PhpErrorException extends ClassFuzzException
{
    public function __construct(int $errno, string $errstr, string $errfile, int $errline)
    {
        $data = [
            'level' => $errno,
            'message' => $errstr,
            'file' => $errfile,
            'line' => $errline,
        ];

        parent::__construct(print_r($data, true));
    }
}
