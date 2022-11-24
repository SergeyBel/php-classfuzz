<?php

namespace PhpClassFuzz\Argument;

class Input
{
    public function __construct(
        public readonly array $arguments
    ) {
    }
}
