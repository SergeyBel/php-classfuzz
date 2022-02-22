<?php

namespace PhpClassFuzz\ExceptionCatcher;

class ForbiddenExceptionListCatcher implements ExceptionCatcherInterface
{
    private array $forbiddenExceptions;


    public function __construct(array $exceptions)
    {
        $this->forbiddenExceptions = $exceptions;
    }


    public function canIgnoreException($throwable): bool
    {
        if (in_array(get_class($throwable), $this->forbiddenExceptions)) {
            return false;
        }
        return true;
    }
}
