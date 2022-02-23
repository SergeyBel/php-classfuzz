<?php

namespace PhpClassFuzz\Mutator;

class Mutators
{
    private array $data;

    private int $current;


    public function __construct(array $data)
    {
        $this->data = $data;
        $this->current = 0;
    }

    public function getNextMutator(): MutatorInterface
    {
        $value = $this->data[$this->current];
        $this->current = ($this->current + 1) % count($this->data);
        return $value;
    }
}
