<?php

namespace PhpClassFuzz\ThrowableCatcher;

use PhpClassFuzz\Fuzz\FuzzInterface;
use Throwable;

class ExceptionCatcherManager
{
    public function canIgnoreThrowable(FuzzInterface $fuzzClass, Throwable $throwable): bool
    {
        return $fuzzClass->ignoreThrowable($throwable);
    }
}
