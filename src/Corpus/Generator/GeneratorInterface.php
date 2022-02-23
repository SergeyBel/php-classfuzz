<?php

namespace PhpClassFuzz\Corpus\Generator;

use PhpClassFuzz\Collection\Corpus;

interface GeneratorInterface
{
    public function generate(int $count): Corpus;
}
