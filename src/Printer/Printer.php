<?php

namespace PhpClassFuzz\Printer;

use PhpClassFuzz\Context\Context;
use PhpClassFuzz\Fuzz\Result\FuzzingExceptionResult;
use PhpClassFuzz\Fuzz\Result\FuzzingFinishedResult;
use PhpClassFuzz\Fuzz\Result\FuzzingPostConditionViolationResult;
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

    public function printException(FuzzingExceptionResult $result)
    {
        $message = 'Exception catch when '.$result->getFuzzClassName().' fuzzed';
        $data = [
            'exception' => $result->getExceptionClass(),
            'message' => $result->getMessage(),
            'arguments' => $result->getInput(),
            'trace' => $this->getTrace(),
        ];
        echo $message."\n";
        echo print_r($data, 1)."\n";
    }

    public function printPostCondition(FuzzingPostConditionViolationResult $result)
    {
        $message = 'Post condition violated when '.$result->getFuzzClassName().' fuzzed';
        $data = [
            'arguments' => $result->getInput(),
            'call_result' => $result->getCallResult(),
            'trace' => $this->getTrace(),
        ];
        echo $message."\n";
        echo print_r($data, 1)."\n";
    }

    public function printFinished(FuzzingFinishedResult $result)
    {
        echo 'Fuzzing finished: '. $result->getRunCount(). " inputs checked\n";
    }

    private function getTrace(): string
    {
        return (new Exception())->getTraceAsString();
    }
}
