<?php

namespace PhpClassFuzz\Mutator\Type\String;

interface StringMutatorInterface
{
    public function mutate(string $str): mixed;
}
