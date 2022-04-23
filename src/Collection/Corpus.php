<?php

namespace PhpClassFuzz\Collection;

use PhpClassFuzz\Exception\CorpusEndException;

class Corpus
{
    /**
     * @var mixed[]
     */
    private array $data;
    private int $current;

    /**
     * @param mixed[] $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->current = 0;
    }

    public function getNextCorpusItem(): mixed
    {
        if ($this->current < count($this->data)) {
            $value = $this->data[$this->current];
            $this->current++;
            return $value;
        }

        throw new CorpusEndException();
    }
}
