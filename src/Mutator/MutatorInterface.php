<?php

namespace PhpClassFuzz\Mutator;

interface MutatorInterface
{
    public function mutate(mixed $input): mixed;
}
