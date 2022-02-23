<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\Mutator\MutatorInterface;
use PhpClassFuzz\Random\Random;

class InsertCharMutator implements MutatorInterface
{
    public function __construct(
        private Random $random
    ) {
    }

    public function mutate($data)
    {
        if (strlen($data) < 1) {
            return $data;
        }
        $char = $this->random->getChar();
        $position = $this->random->getInt(0, strlen($data) - 1);
        return substr_replace($data, $char, $position, 0);
    }
}
