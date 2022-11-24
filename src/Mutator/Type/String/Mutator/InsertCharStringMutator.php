<?php

namespace PhpClassFuzz\Mutator\Type\String\Mutator;

use PhpClassFuzz\Mutator\Type\String\StringMutatorInterface;
use PhpClassFuzz\Random\Random;

class InsertCharStringMutator implements StringMutatorInterface
{
    public function __construct(
        private Random $random
    ) {
    }


    public function mutate(string $str): string
    {
        $char = $this->random->getSymbol();
        if (strlen($str) == 0) {
            return $char;
        }
        $position = $this->random->getInt(0, strlen($str));
        return substr_replace($str, $char, $position, 0);
    }
}
