<?php

namespace PhpClassFuzz\Mutator\Type\Array\Mutator;

use PhpClassFuzz\Mutator\Type\Array\ArrayMutatorInterface;
use PhpClassFuzz\Mutator\TypeMutator;
use PhpClassFuzz\Random\Random;

class MutateArrayKeyMutator implements ArrayMutatorInterface
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
            if ($this->random->getBool()) {
                break;
            }
            $d = & $d[$nextKey];
        }

        if (!is_array($d)) {
            return $data;
        }

        $mutatedKey = $this->typeMutator->mutateValue($nextKey);
        $d[$mutatedKey] = $d[$nextKey];
        unset($d[$nextKey]);

        return $data;
    }
}
