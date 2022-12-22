<?php

namespace PhpClassFuzz\Fuzzer\FuzzingInput;

class FuzzingInputQueue
{
    /**
     * @var FuzzingInput[]
     */
    private array $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function push(FuzzingInput $element): void
    {
        array_push($this->data, $element);
    }

    public function pop(): FuzzingInput
    {
        return array_pop($this->data);
    }

    public function isEmpty(): bool
    {
        return empty($this->data);
    }
}
