<?php

namespace PhpClassFuzz\Argument;

use PhpClassFuzz\Corpus\Corpus;
use PhpClassFuzz\Mutator\Mutators;

class Argument
{
    private Corpus $corpus;
    private Mutators $mutators;


    public function __construct(Corpus $corpus, Mutators $mutators)
    {
        $this->corpus = $corpus;
        $this->mutators = $mutators;
    }


    public function getCorpus(): Corpus
    {
        return $this->corpus;
    }


    public function getMutators(): Mutators
    {
        return $this->mutators;
    }
}
