<?php

namespace PhpClassFuzz\Fuzz\Result;

use Throwable;

class FuzzingExceptionResult implements FuzzingResultInterface
{
    private string $fuzzClassName;

    private string $exceptionClass;

    private string $message;

    private $input;

    public function __construct($fuzzClass, Throwable $e, $input)
    {
        $this->fuzzClassName = get_class($fuzzClass);
        $this->exceptionClass = get_class($e);
        $this->message = $e->getMessage();
        $this->input = $input;
        $this->trace = $e->getTraceAsString();
    }


    public function getExceptionClass(): string
    {
        return $this->exceptionClass;
    }


    public function getMessage(): string
    {
        return $this->message;
    }



    public function getInput()
    {
        return $this->input;
    }


    public function getFuzzClassName(): string
    {
        return $this->fuzzClassName;
    }
}
