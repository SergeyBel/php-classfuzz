<?php

namespace PhpClassFuzz\Mutator;

use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Mutator\Type\String\StringMutator;

class ArgumentMutator
{
    public function __construct(
        private StringMutator $stringMutator
    ) {
    }

    public function mutateArgument(Argument $argument): Argument
    {
        $value = $argument->value;
        $type = gettype($value);
        $mutatedValue = match ($type) {
            'string' => $this->stringMutator->mutate($value),
            default => throw new MutatorUnknownTypeException('Unknown mutator type: '.$type)
        };
        return new Argument($mutatedValue);
    }
}
