<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\Mutator\MutatorInterface;
use PhpClassFuzz\Random\Random;

class DeleteCharMutator implements MutatorInterface
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
        $position = $this->random->getInt(0, strlen($input) - 1);
        return substr_replace($input, '', $position, 1);
    }


    public function setRandom(Random $random): self
    {
        $this->random = $random;
        return $this;
    }
}
