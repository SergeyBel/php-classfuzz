<?php

namespace PhpClassFuzz\Runner;

class RunnerConfiguration
{
    private string $directory;


    public function getDirectory(): string
    {
        return $this->directory;
    }


    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;
        return $this;
    }
}
