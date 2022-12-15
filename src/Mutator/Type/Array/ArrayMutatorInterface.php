<?php

namespace PhpClassFuzz\Mutator\Type\Array;

interface ArrayMutatorInterface
{
    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function mutate(array $data): array;
}
