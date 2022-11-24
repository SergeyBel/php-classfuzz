<?php

namespace PhpClassFuzz\Mutator\Type\String\Mutator;

use PhpClassFuzz\Mutator\Type\String\StringMutatorInterface;
use PhpClassFuzz\Random\Random;

class DeleteCharStringMutator implements StringMutatorInterface
{
    public function __construct(
        private Random $random
    ) {
    }


    public function mutate(string $str): string
    {
        if (strlen($str) == 0) {
            return $str;
        }
        $position = $this->random->getInt(0, strlen($str) - 1);
        return substr_replace($str, '', $position, 1);
    }
}
