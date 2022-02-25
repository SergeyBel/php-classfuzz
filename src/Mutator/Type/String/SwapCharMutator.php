<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\Mutator\MutatorInterface;
use PhpClassFuzz\Random\Random;

class SwapCharMutator implements MutatorInterface
{
    public function __construct(
        private Random $random,
    ) {
    }
    public function mutate($input)
    {
        if (strlen($input) == 0) {
            return $input;
        }
        $first = $this->random->getInt(0, strlen($input) - 1);
        $second = $this->random->getInt(0, strlen($input) - 1);
        return $this->swap($input, $first, $second);
    }

    private function swap(string $input, int $first, int $second): string
    {
        $tmp = $input[$first];
        $input[$first] = $input[$second];
        $input[$second] = $tmp;
        return $input;
    }
}
