<?php

namespace PhpClassFuzz\Mutator\Type\Array\Mutator;

use PhpClassFuzz\Mutator\Type\Array\ArrayMutatorInterface;
use PhpClassFuzz\Random\Random;

class InsertKeyMutate implements ArrayMutatorInterface
{
    public function __construct(
        private Random $random
    ) {
    }


    public function mutate(array $data): array
    {
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

        $length = $this->random->getInt(1, 10);
        $key = $this->random->getString($length);
        $value = $this->random->getString($length);
        $d[$key] = $value;

        return $data;
    }
}
