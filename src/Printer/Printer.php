<?php

namespace PhpClassFuzz\Printer;

use PhpClassFuzz\Fuzz\Result\FuzzingExceptionResult;
use PhpClassFuzz\Fuzz\Result\FuzzingFinishedResult;
use PhpClassFuzz\Fuzz\Result\FuzzingPostConditionViolationResult;
use Exception;

class Printer
{
    public function printException(FuzzingExceptionResult $result): void
    {
        $message = 'Exception catch when '.$result->getFuzzClassName().' fuzzed';
        $data = [
            'exception' => $result->getExceptionClass(),
            'message' => $result->getMessage(),
            'arguments' => $result->getInput(),
            'trace' => $this->getTrace(),
        ];
        echo $message."\n";
        echo print_r($data, true)."\n";
    }

    public function printPostCondition(FuzzingPostConditionViolationResult $result): void
    {
        $message = 'Post condition violated when '.$result->getFuzzClassName().' fuzzed';
        $data = [
            'arguments' => $result->getInput(),
            'call_result' => $result->getCallResult(),
            'trace' => $this->getTrace(),
        ];
        echo $message."\n";
        echo print_r($data, true)."\n";
    }

    public function printFinished(FuzzingFinishedResult $result): void
    {
        echo 'Fuzzing finished: '. $result->getRunCount(). " inputs checked\n";
    }

    private function getTrace(): string
    {
        return (new Exception())->getTraceAsString();
    }
}
