<?php

namespace PhpClassFuzz\Runner\Configuration;

class RunnerConfiguration
{
    public function __construct(
        public string $directory,
        public bool $isDebug,
    ) {
    }
}
