<?php

namespace PhpClassFuzz\Mutator;

use PhpClassFuzz\Argument\Argument;

class ArgumentMutator
{
    public function __construct(
        private TypeMutator $typeMutator
    ) {
    }

    public function mutateArgument(Argument $argument): Argument
    {
        return new Argument($this->typeMutator->mutateValue($argument->value));
    }
}
