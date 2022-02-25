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
    }


    public function getPostConditions(): array
    {
        return [];
    }
}
