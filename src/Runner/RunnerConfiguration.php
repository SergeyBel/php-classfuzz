<?php

namespace PhpClassFuzz\Runner;

class RunnerConfiguration
{
    private string $directory;

    private int $runCount = 5;

    /**
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     */
    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * @return int
     */
    public function getRunCount(): int
    {
        return $this->runCount;
    }

    /**
     * @param int $runCount
     */
    public function setRunCount(int $runCount): self
    {
        $this->runCount = $runCount;
        return $this;
    }
}
