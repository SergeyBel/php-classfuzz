<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Argument\Arguments;

class BaseFuzz implements FuzzInterface
{
    public function getArguments(): Arguments
    {
    }

    public function getExceptionCatchers(): array
    {
    }

    public function getMaxCount(): int
    {
        return 1000;
    }
}