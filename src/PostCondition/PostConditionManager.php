<?php

namespace PhpClassFuzz\PostCondition;

use PhpClassFuzz\Argument\Input;
use PhpClassFuzz\Fuzz\FuzzInterface;

class PostConditionManager
{
    public function checkPostCondition(FuzzInterface $fuzzClass, Input $input, mixed $result): bool
    {
        return $fuzzClass->metPostCondition($input, $result);
    }
}
