<?php

namespace PhpClassFuzz\Fuzz\Result;

use PhpClassFuzz\PostCondition\PostConditionInterface;

class FuzzingPostConditionViolationResult implements FuzzingResultInterface
{
    private string $fuzzClassName;
    private string $postConditionClassName;
    private $callResult;
    private $input;


    public function __construct($fuzzClass, PostConditionInterface $violatedPostCondition, $input, $callResult)
    {
        $this->fuzzClassName = get_class($fuzzClass);
        $this->postConditionClassName = get_class($violatedPostCondition);
        $this->input = $input;
        $this->callResult = $callResult;
    }


    public function getPostConditionClassName(): string
    {
        return $this->postConditionClassName;
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
