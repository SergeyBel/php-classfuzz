<?php

namespace PhpClassFuzz\PostCondition;

use PhpClassFuzz\Fuzz\FuzzInterface;

class PostConditionManager
{
    public function checkPostCondition(FuzzInterface $fuzzClass, mixed $result): bool
    {
        return $fuzzClass->metPostCondition($result);
    }
}
