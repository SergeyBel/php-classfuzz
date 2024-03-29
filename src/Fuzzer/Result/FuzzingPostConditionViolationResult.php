<?php

namespace PhpClassFuzz\Fuzzer\Result;

use PhpClassFuzz\Argument\Input;
use PhpClassFuzz\Fuzz\FuzzInterface;

class FuzzingPostConditionViolationResult implements FuzzingResultInterface
{
    private string $fuzzClassName;
    private mixed $callResult;
    private mixed $input;


    public function __construct(FuzzInterface $fuzzClass, Input $input, mixed $callResult)
    {
        $this->fuzzClassName = get_class($fuzzClass);
        $this->input = $input;
        $this->callResult = $callResult;
    }

    public function getFuzzClassName(): string
    {
        return $this->fuzzClassName;
    }

    public function getCallResult(): mixed
    {
        return $this->callResult;
    }

    public function getInput(): Input
    {
        return $this->input;
    }
}
