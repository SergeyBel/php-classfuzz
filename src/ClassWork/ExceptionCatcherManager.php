<?php

namespace PhpClassFuzz\ClassWork;

use Throwable;

class ExceptionCatcherManager
{
    public function canIgnoreException(string $className, Throwable $throwable): bool
    {
        $catchers = (new $className())->getExceptionCatchers();
        foreach ($catchers as $cather) {
            if (!$cather->canIgnoreException($throwable)) {
                return false;
            }
        }
        return true;
    }
}
