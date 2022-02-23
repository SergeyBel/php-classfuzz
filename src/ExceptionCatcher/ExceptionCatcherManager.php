<?php

namespace PhpClassFuzz\ExceptionCatcher;

use PhpClassFuzz\Fuzz\FuzzInterface;
use Throwable;

class ExceptionCatcherManager
{
    public function canIgnoreException(FuzzInterface $fuzzClass, Throwable $throwable): bool
    {
        $catchers = $fuzzClass->getExceptionCatchers();
        foreach ($catchers as $cather) {
            if (!$cather->canIgnoreException($throwable)) {
                return false;
            }
        }
        return true;
    }
}
