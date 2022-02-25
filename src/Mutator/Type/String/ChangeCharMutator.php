<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\Mutator\MutatorInterface;
use PhpClassFuzz\Random\Random;

class ChangeCharMutator implements MutatorInterface
{
    public function __construct(
        private Random $random
    ) {
    }

    public function mutate($input)
    {
        if (strlen($input) == 0) {
            return $input;
        }
        $char = $this->random->getSymbol();
        $position = $this->random->getInt(0, strlen($input) - 1);
        return substr_replace($input, $char, $position, 1);
    }
}
