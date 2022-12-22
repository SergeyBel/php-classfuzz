<?php

namespace PhpClassFuzz\Argument;

class Input
{
    public function __construct(
        /** @var Argument[]*/
        public readonly array $arguments
    ) {
    }

    /**
     * @return array<mixed>
     */
    public function getArgumentsValues(): array
    {
        $data = [];
        foreach ($this->arguments as $argument) {
            $data[] = $argument->value;
        }

        return $data;
    }
}
