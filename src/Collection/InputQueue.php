<?php

namespace PhpClassFuzz\Collection;

class InputQueue
{
    private array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function push($element)
    {
        array_push($this->data, $element);
    }

    public function pop()
    {
        return array_pop($this->data);
    }

    public function isEmpty(): bool
    {
        return empty($this->data);
    }
}
