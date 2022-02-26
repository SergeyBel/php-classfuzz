<?php

namespace PhpClassFuzz\Fuzz\Result;

class FuzzingFinishedResult implements FuzzingResultInterface
{
    private string $fuzzClassName;

    private int $runCount;


    public function __construct($fuzzClass, int $runCount)
    {
        $this->fuzzClassName = get_class($fuzzClass);
        $this->runCount = $runCount;
    }


    public function getRunCount(): int
    {
        return $this->runCount;
    }


    public function getFuzzClassName(): string
    {
        return $this->fuzzClassName;
    }
}
