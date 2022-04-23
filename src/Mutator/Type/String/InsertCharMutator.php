<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\Mutator\MutatorInterface;
use PhpClassFuzz\Random\Random;

class InsertCharMutator implements MutatorInterface
{
    private Random $random;

    public function __construct(

    ) {
        $this->random = new Random();
    }

    /**
     * @param string $input
     */
    public function mutate($input): string
    {
        $char = $this->random->getSymbol();
        if (strlen($input) == 0) {
            return $char;
        }
        $position = $this->random->getInt(0, strlen($input));
        return substr_replace($input, $char, $position, 0);
    }


    public function setRandom(Random $random): self
    {
        $this->random = $random;
        return $this;
    }
}
