<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Argument\Input;
use Throwable;

class BaseFuzz implements FuzzInterface
{
    public function getInputs(): array
    {
        throw new ClassFuzzException('getArgument must be implemented');
    }

    public function ignoreThrowable(Throwable $throwable): bool
    {
        return false;
    }

    public function getMaxCount(): ?int
    {
        return 1000;
    }


    public function metPostCondition(Input $input, mixed $callResult): bool
    {
        return true;
    }

    public function getCoveragePath(): ?string
    {
        return null;
    }
}
