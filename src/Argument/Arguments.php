<?php

namespace PhpClassFuzz\Argument;

class Arguments
{
    private array $data = [];

    public function setArgument(int $index, Argument $argument): self
    {
        $this->data[$index] = $argument;
        return $this;
    }

    /**
     * @return array<Argument>
     */
    public function getArguments(): array
    {
        return $this->data;
    }
}
