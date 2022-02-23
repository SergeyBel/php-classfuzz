<?php

namespace PhpClassFuzz\Mutator;

class Mutators
{
    private array $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getMutators(): array
    {
        return $this->data;
    }
}
