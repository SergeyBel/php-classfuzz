<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\Random\Random;

class StringMutator
{
    public function __construct(
        /** @var array<StringMutatorInterface> */
        private iterable $mutators,
        private Random $random,
    ) {
    }

    public function mutate(string $str): string
    {
        $mutators = $this->mutators;
        /** @var StringMutatorInterface $mutator */
        $mutator = $this->random->getValueFromArray(iterator_to_array($mutators));
        return $mutator->mutate($str);
    }
}
