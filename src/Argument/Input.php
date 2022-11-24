<?php

namespace PhpClassFuzz\Argument;

class Input
{
    public function __construct(
        /** @var Argument[]*/
        public readonly array $arguments
    ) {
    }
}
