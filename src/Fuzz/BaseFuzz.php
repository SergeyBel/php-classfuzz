<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Argument\Argument;

class BaseFuzz implements FuzzInterface
{
    public function getArgument(): Argument
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
