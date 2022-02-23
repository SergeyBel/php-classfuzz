<?php

namespace PhpClassFuzz\Runner;

class RunnerConfiguration
{
    private string $directory;

    private bool $debug;


    public function getDirectory(): string
    {
        return $this->directory;
    }


    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;
        return $this;
    }


    public function isDebug(): bool
    {
        return $this->debug;
    }


    public function setDebug(bool $debug): self
    {
        $this->debug = $debug;
        return $this;
    }
}
