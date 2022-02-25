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

    public function mutate($input)
    {
        $char = $this->random->getChar();
        if (strlen($input) == 0) {
            return $char;
        }
        $position = $this->random->getInt(0, strlen($input));
        return substr_replace($input, $char, $position, 0);
    }
}
