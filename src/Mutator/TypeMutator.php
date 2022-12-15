<?php

namespace PhpClassFuzz\Mutator;

use PhpClassFuzz\Mutator\Type\Array\ArrayMutator;
use PhpClassFuzz\Mutator\Type\String\StringMutator;

class TypeMutator
{
    public function __construct(
        private StringMutator $stringMutator,
        private ArrayMutator $arrayMutator
    ) {
    }

    public function mutateValue(mixed $value): mixed
    {
        $type = gettype($value);
        $mutatedValue = match ($type) {
            'string' => $this->stringMutator->mutate($value),
            'integer' => $this->stringMutator->mutate((string)$value),
            'array' => $this->arrayMutator->mutate($value),
            default => throw new MutatorUnknownTypeException('Unknown mutator type: '.$type)
        };
        return $mutatedValue;
    }
}
