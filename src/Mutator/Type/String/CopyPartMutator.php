<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\Mutator\MutatorInterface;
use PhpClassFuzz\Random\Random;

class CopyPartMutator implements MutatorInterface
{
    private Random $random;

    public function __construct(

    ) {
        $this->random = new Random();
    }

    public function mutate($input)
    {
        if (strlen($input) == 0) {
            return $input;
        }
        $partStart = $this->random->getInt(0, strlen($input) - 1);
        $partEnd = $this->random->getInt($partStart, strlen($input) - 1);
        $length = $partEnd - $partStart + 1;
        $part = substr($input, $partStart, $length);
        return substr_replace($input, $part.$part, $partStart, $length);
    }


    public function setRandom(Random $random): self
    {
        $this->random = $random;
        return $this;
    }
}
