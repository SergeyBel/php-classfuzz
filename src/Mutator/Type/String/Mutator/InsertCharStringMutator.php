<?php

namespace PhpClassFuzz\Mutator\Type\String\Mutator;

use PhpClassFuzz\Mutator\Type\String\StringMutatorInterface;
use PhpClassFuzz\Random\Random;

class InsertCharStringMutator implements StringMutatorInterface
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
        $char = $this->random->getSymbol();
        if (strlen($str) == 0) {
            return $char;
        }
        $position = $this->random->getInt(0, strlen($str));
        return substr_replace($str, $char, $position, 0);
    }


    public function setRandom(Random $random): self
    {
        $this->random = $random;
        return $this;
    }
}
