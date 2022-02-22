<?php

namespace PhpClassFuzz\Runner;

class RunnerConfiguration
{
    private string $directory;

    private int $runCount = 5;


    public function getDirectory(): string
    {
        return $this->directory;
    }


    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;
        return $this;
    }


    public function getRunCount(): int
    {
        return $this->runCount;
    }


    public function setRunCount(int $runCount): self
    {
        $this->runCount = $runCount;
        return $this;
    }
}
