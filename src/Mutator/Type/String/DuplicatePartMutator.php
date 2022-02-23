<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\Mutator\MutatorInterface;
use PhpClassFuzz\Random\Random;

class DuplicatePartMutator implements MutatorInterface
{
    public function __construct(
        private Random $random
    ) {
    }

    public function mutate($data)
    {
        if (strlen($data) < 2) {
            return $data;
        }
        $partStart = $this->random->getInt(0, strlen($data) - 2);
        $partEnd = $this->random->getInt($partStart + 1, strlen($data) - 1);
        $length = $partEnd - $partStart + 1;
        $part = substr($data, $partStart, $length);
        return substr_replace($data, $part.$part, $partStart, 2 * $length);
    }
}
