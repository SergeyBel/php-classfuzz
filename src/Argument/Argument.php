<?php

namespace PhpClassFuzz\Argument;

use PhpClassFuzz\Collection\Corpus;

class Argument
{
    private Corpus $corpus;
    private array $mutators;


    public function __construct(Corpus $corpus, array $mutators)
    {
        $this->corpus = $corpus;
        $this->mutators = $mutators;
    }


    public function getCorpus(): Corpus
    {
        return $this->corpus;
    }


    public function getMutators(): array
    {
        return $this->mutators;
    }
}
