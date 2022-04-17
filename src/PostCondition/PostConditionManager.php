<?php

namespace PhpClassFuzz\PostCondition;

use PhpClassFuzz\Fuzz\FuzzInterface;

class PostConditionManager
{
    public function checkPostCondition(FuzzInterface $fuzzClass, $result): bool
    {
        return $fuzzClass->metPostCondition($result);
    }
}
