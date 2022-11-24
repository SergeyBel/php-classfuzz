<?php

namespace PhpClassFuzz\Mutator\Type\String\Mutator;


use PhpClassFuzz\Mutator\Type\String\StringMutatorInterface;
use PhpClassFuzz\Random\Random;

class DeleteCharStringMutator implements StringMutatorInterface
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
        $position = $this->random->getInt(0, strlen($str) - 1);
        return substr_replace($str, '', $position, 1);
    }


    public function setRandom(Random $random): self
    {
        $this->random = $random;
        return $this;
    }
}
