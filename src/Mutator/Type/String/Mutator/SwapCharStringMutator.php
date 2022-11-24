<?php

namespace PhpClassFuzz\Mutator\Type\String\Mutator;

use PhpClassFuzz\Mutator\Type\String\StringMutatorInterface;
use PhpClassFuzz\Random\Random;

class SwapCharStringMutator implements StringMutatorInterface
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
        $first = $this->random->getInt(0, strlen($str) - 1);
        $second = $this->random->getInt(0, strlen($str) - 1);
        return $this->swap($str, $first, $second);
    }

    private function swap(string $input, int $first, int $second): string
    {
        $tmp = $input[$first];
        $input[$first] = $input[$second];
        $input[$second] = $tmp;
        return $input;
    }
}
