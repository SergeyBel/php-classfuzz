<?php

namespace PhpClassFuzz\ExceptionCatcher;

class AllowedExceptionListCatcher implements ExceptionCatcherInterface
{
    private array $allowedExceptions;


    public function __construct(array $exceptions = [])
    {
        $this->allowedExceptions = $exceptions;
    }


    public function canIgnoreException($throwable): bool
    {
        if (!in_array(get_class($throwable), $this->allowedExceptions)) {
            return false;
        }
        return true;
    }
}
