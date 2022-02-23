<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Argument\Arguments;

interface FuzzInterface
{
    public function getArguments(): Arguments;
    public function getExceptionCatchers(): array;
    public function getMaxCount(): int;
}
