<?php

namespace PhpClassFuzz\Argument;

use PhpClassFuzz\Collections\Mutators;
use PhpClassFuzz\Corpus\Corpus;

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
