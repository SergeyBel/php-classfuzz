<?php

namespace PhpClassFuzz\Mutator\Type\Array;

use PhpClassFuzz\Random\Random;

class ArrayMutator
{
    public function __construct(
        /** @var array<ArrayMutatorInterface> */
        private iterable $mutators,
        private Random $random,
    ) {
    }

    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function mutate(array $data): array
    {
        $mutator = $this->random->getValueFromArray(iterator_to_array($this->mutators));
        return $mutator->mutate($data);
    }
}
