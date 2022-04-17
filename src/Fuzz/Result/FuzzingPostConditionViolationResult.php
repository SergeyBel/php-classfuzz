<?php

namespace PhpClassFuzz\Fuzz\Result;

class FuzzingPostConditionViolationResult implements FuzzingResultInterface
{
    private string $fuzzClassName;
    private $callResult;
    private $input;


    public function __construct($fuzzClass, $input, $callResult)
    {
        $this->fuzzClassName = get_class($fuzzClass);
        $this->input = $input;
        $this->callResult = $callResult;
    }


    public function getCallResult()
    {
        return $this->callResult;
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
