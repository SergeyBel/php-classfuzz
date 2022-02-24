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
        return [];
    }

    public function getMaxCount(): int
    {
        return 1000;
    }

    public function getPostConditions(): array
    {
        return [];
    }
}
