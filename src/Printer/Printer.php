<?php

namespace PhpClassFuzz\Printer;

use PhpClassFuzz\Context\Context;
use PhpClassFuzz\PostCondition\PostConditionInterface;
use Throwable;
use Exception;

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
            'arguments' => Context::getInput()
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
            'arguments' => Context::getInput(),
            'trace' => $e->getTraceAsString(),
        ];
        echo $message."\n";
        echo print_r($data, 1)."\n";
    }

    public function printPostCondition(PostConditionInterface $postCondition, $callResult)
    {
        $message = 'Post condition violated when '.Context::getFuzzClassName().' fuzzed';
        $data = [
            'post_condition' => get_class($postCondition),
            'arguments' => implode(', ', Context::getInput()),
            'result' => print_r($callResult, 2),
            'trace' => (new Exception())->getTraceAsString(),
        ];
        echo $message."\n";
        echo print_r($data, 1)."\n";
    }
}
