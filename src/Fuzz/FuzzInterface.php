<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Argument\Argument;
use Throwable;

interface FuzzInterface
{
    public function getArgument(): Argument;


    public function ignoreThrowable(Throwable $throwable): bool;

    public function getMaxCount(): int;

    public function metPostCondition(mixed $callResult): bool;
}
