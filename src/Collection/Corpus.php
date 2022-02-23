<?php

namespace PhpClassFuzz\Collection;

class Corpus
{
    private array $data;
    private int $current;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->current = 0;
    }
    public function getNextCorpusItem()
    {
        if ($this->current < count($this->data)) {
            $value = $this->data[$this->current];
            $this->current++;
            return $value;
        }

        throw new CorpusEndException();
    }
}
