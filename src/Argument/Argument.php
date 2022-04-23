<?php

namespace PhpClassFuzz\Argument;

use PhpClassFuzz\Collection\Corpus;
use PhpClassFuzz\Mutator\MutatorInterface;

class Argument
{
    private Corpus $corpus;

    /** @var MutatorInterface[]  */
    private array $mutators;

    /**
     * @param MutatorInterface[] $mutators
     */
    public function __construct(Corpus $corpus, array $mutators)
    {
        $this->corpus = $corpus;
        $this->mutators = $mutators;
    }


    public function getCorpus(): Corpus
    {
        return $this->corpus;
    }

    /**
     * @return MutatorInterface[]
     */
    public function getMutators(): array
    {
        return $this->mutators;
    }
}
