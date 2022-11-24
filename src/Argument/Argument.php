<?php

namespace PhpClassFuzz\Argument;

use PhpClassFuzz\Collection\Corpus;
use PhpClassFuzz\Mutator\StringMutatorInterface;

class Argument
{
    public function __construct(
        public readonly mixed $value
    ) {}
}
