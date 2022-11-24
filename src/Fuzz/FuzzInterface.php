<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Argument\Input;
use Throwable;

interface FuzzInterface
{
    /**
     * @return Input[]
     */
    public function getInputs(): array;

    public function ignoreThrowable(Throwable $throwable): bool;

    public function getMaxCount(): ?int;

    public function metPostCondition(mixed $callResult): bool;

    public function getCoveragePath(): ?string;
}
