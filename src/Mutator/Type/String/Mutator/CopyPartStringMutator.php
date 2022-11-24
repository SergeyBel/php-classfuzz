<?php

namespace PhpClassFuzz\Mutator\Type\String\Mutator;

use PhpClassFuzz\Mutator\Type\String\StringMutatorInterface;
use PhpClassFuzz\Random\Random;

class CopyPartStringMutator implements StringMutatorInterface
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
        $partStart = $this->random->getInt(0, strlen($str) - 1);
        $partEnd = $this->random->getInt($partStart, strlen($str) - 1);
        $length = $partEnd - $partStart + 1;
        $part = substr($str, $partStart, $length);
        return substr_replace($str, $part.$part, $partStart, $length);
    }
}
