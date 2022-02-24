<?php

namespace PhpClassFuzz\PostCondition;

interface PostConditionInterface
{
    public function checkPostCondition($callResult): bool;
}
