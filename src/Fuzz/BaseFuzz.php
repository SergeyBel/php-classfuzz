<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Argument\Argument;
use Throwable;

class BaseFuzz implements FuzzInterface
{
    public function getArgument(): Argument
    {
    }

    public function ignoreThrowable(Throwable $throwable): bool
    {
        return false;
    }

    public function getMaxCount(): int
    {
    }


    public function metPostCondition(mixed $callResult): bool
    {
        return true;
    }
}
