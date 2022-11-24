<?php

namespace PhpClassFuzz\Mutator\Type\String\Mutator;

use PhpClassFuzz\Mutator\Type\String\StringMutatorInterface;
use PhpClassFuzz\Random\Random;

class SwapCharStringMutator implements StringMutatorInterface
{
    private Random $random;

    public function __construct(

    ) {
        $this->random = new Random();
    }

    /**
     * @param string $str
     */
    public function mutate($str): string
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


    public function setRandom(Random $random): self
    {
        $this->random = $random;
        return $this;
    }
}
