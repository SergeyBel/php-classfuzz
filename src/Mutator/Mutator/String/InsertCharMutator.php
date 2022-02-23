<?php

namespace PhpClassFuzz\Mutator\Mutator\String;

use PhpClassFuzz\Mutator\MutatorInterface;

class InsertCharMutator implements MutatorInterface
{
    public function mutate($data)
    {
        if (strlen($data) < 1) {
            return $data;
        }
        $char = chr(random_int(0, 255));
        $position = random_int(0, strlen($data) - 1);
        return substr_replace($data, $char, $position, 0);
    }
}
