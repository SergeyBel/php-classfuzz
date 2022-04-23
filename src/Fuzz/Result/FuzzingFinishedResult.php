<?php

namespace PhpClassFuzz\Fuzz\Result;

class FuzzingFinishedResult implements FuzzingResultInterface
{
    private int $runCount;


    public function __construct(int $runCount)
    {
        $this->runCount = $runCount;
    }

    public function getRunCount(): int
    {
        return $this->runCount;
    }
}
