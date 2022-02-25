<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\Mutator\MutatorInterface;
use PhpClassFuzz\Random\Random;

class CopyPartMutator implements MutatorInterface
{
    public function __construct(
        private Random $random
    ) {
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
}
