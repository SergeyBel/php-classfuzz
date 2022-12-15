<?php

namespace PhpClassFuzz\Mutator\Type\Array\Mutator;

use PhpClassFuzz\Mutator\Type\Array\ArrayMutatorInterface;
use PhpClassFuzz\Mutator\TypeMutator;
use PhpClassFuzz\Random\Random;

class MutateArrayValueMutator implements ArrayMutatorInterface
{
    public function __construct(
        private Random $random,
        private TypeMutator $typeMutator
    ) {
    }

    public function mutate(array $data): array
    {
        if (empty($data)) {
            return $data;
        }


        $d = &$data;

        while (is_array($d) && !empty($d)) {
            $nextKey = $this->random->getKeyFromArray($d);
            $d = & $d[$nextKey];
        }

        $d = $this->typeMutator->mutateValue($d);


        return $data;
    }
}
