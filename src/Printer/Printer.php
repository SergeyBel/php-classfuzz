<?php

namespace PhpClassFuzz\Printer;

use PhpClassFuzz\Context\Context;
use Throwable;

class Printer
{
    public function printPhpError($errno, $errstr, $errfile, $errline)
    {
        $message = 'Php error catched when '.Context::getFuzzClassName().' fuzzed';
        $data = [
            'level' => $errno,
            'message' => $errstr,
            'file' => $errfile,
            'line' => $errline,
            'arguments' => implode(', ', Context::getArgs()),
        ];

        echo $message."\n";
        echo json_encode($data, JSON_PRETTY_PRINT)."\n";
    }

    public function printException(Throwable $e)
    {
        $message = 'Exception catched when '.Context::getFuzzClassName().' fuzzed';
        $data = [
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'arguments' => implode(', ', Context::getArgs()),
        ];
        echo $message."\n";
        echo json_encode($data, JSON_PRETTY_PRINT)."\n";
    }
}
