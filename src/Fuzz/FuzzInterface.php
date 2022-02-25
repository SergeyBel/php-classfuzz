<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\ExceptionCatcher\ExceptionCatcherInterface;
use PhpClassFuzz\PostCondition\PostConditionInterface;

interface FuzzInterface
{
    public function getArgument(): Argument;

    /**
     * @return array<ExceptionCatcherInterface>
     */
    public function getExceptionCatchers(): array;
    public function getMaxCount(): int;

    /**
     * @return array<PostConditionInterface>
     */
    public function getPostConditions(): array;
}
