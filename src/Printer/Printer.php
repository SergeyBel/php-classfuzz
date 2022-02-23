<?php

namespace PhpClassFuzz\Printer;

use PhpClassFuzz\Context\Context;
use Throwable;

class Printer
{
    public function printPhpError($errno, $errstr, $errfile, $errline)
    {
        $message = 'Php error catch when '.Context::getFuzzClassName().' fuzzed';
        $data = [
            'level' => $errno,
            'message' => $errstr,
            'file' => $errfile,
            'line' => $errline,
            'arguments' => implode(', ', Context::getArgs()),
        ];

        echo $message."\n";
        echo print_r($data, 1)."\n";
    }

    public function printException(Throwable $e)
    {
        $message = 'Exception catch when '.Context::getFuzzClassName().' fuzzed';
        $data = [
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'arguments' => implode(', ', Context::getArgs()),
        ];
        echo $message."\n";
        echo print_r($data, 1)."\n";
    }
}
