<?php

namespace PhpClassFuzz\Mutator\Type\String\Mutator;

use PhpClassFuzz\Mutator\Type\String\StringMutatorInterface;
use PhpClassFuzz\Random\Random;

class CopyPartStringMutator implements StringMutatorInterface
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
        $partStart = $this->random->getInt(0, strlen($str) - 1);
        $partEnd = $this->random->getInt($partStart, strlen($str) - 1);
        $length = $partEnd - $partStart + 1;
        $part = substr($str, $partStart, $length);
        return substr_replace($str, $part.$part, $partStart, $length);
    }


    public function setRandom(Random $random): self
    {
        $this->random = $random;
        return $this;
    }
}
