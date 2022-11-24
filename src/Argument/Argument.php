<?php

namespace PhpClassFuzz\Argument;

class Argument
{
    public function __construct(
        public readonly mixed $value
    ) {
    }
}
