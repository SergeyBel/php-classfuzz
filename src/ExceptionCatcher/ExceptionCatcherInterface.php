<?php

namespace PhpClassFuzz\ExceptionCatcher;

interface ExceptionCatcherInterface
{
    public function canIgnoreException($throwable): bool;
}
