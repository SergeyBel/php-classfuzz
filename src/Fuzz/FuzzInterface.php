<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\ExceptionCatcher\ExceptionCatcherInterface;
use PhpClassFuzz\PostCondition\PostConditionInterface;

interface FuzzInterface
{
    public function getArgument(): Argument;


    public function ignoreThrowable(\Throwable $throwable): bool;

    public function getMaxCount(): int;

    /**
     * @return array<PostConditionInterface>
     */
    public function getPostConditions(): array;
}
