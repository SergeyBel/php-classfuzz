<?php

namespace PhpClassFuzz\Argument;

class InputQueue
{
    /**
     * @var mixed[]
     */
    private array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function push(mixed $element): void
    {
        array_push($this->data, $element);
    }

    public function pop(): mixed
    {
        return array_pop($this->data);
    }

    public function isEmpty(): bool
    {
        return empty($this->data);
    }
}
