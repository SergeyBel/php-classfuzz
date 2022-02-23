<?php

namespace PhpClassFuzz\Mutator\Mutator\String;

use PhpClassFuzz\Mutator\MutatorInterface;

class DuplicatePartMutator implements MutatorInterface
{
    public function mutate($data)
    {
        if (strlen($data) < 2) {
            return $data;
        }
        $partStart = random_int(0, strlen($data) - 2);
        $partEnd = random_int($partStart + 1, strlen($data) - 1);
        $length = $partEnd - $partStart + 1;
        $part = substr($data, $partStart, $length);
        return substr_replace($data, $part.$part, $partStart, 2 * $length);
    }
}
