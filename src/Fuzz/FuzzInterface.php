<?php

namespace PhpClassFuzz\Fuzz;

use PhpClassFuzz\Corpus\Corpus;
use PhpClassFuzz\Mutator\Mutators;

interface FuzzInterface
{
    public function getCorpus(): Corpus;

    public function getMutators(): Mutators;

    public function getExceptionCatchers(): array;

    public function getMaxCount(): int;
}
