<?php

use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Argument\Arguments;
use PhpClassFuzz\Corpus\Corpus;
use PhpClassFuzz\Corpus\Generator\CharStringCorpus;
use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Mutator\Mutator\String\InsertCharMutator;
use PhpClassFuzz\Mutator\Mutators;
use \PhpClassFuzz\ExceptionCatcher\Catcher\AllowedExceptionListCatcher;


class SimpleFuzz implements FuzzInterface
{
    public function getArguments(): Arguments
    {
        $args = new Arguments();
        $args->setArgument(0, new Argument(
            (new CharStringCorpus())->generate(100),
            new Mutators([new InsertCharMutator()])
        ));

        return $args;

    }

    public function getExceptionCatchers(): array
    {
        return [
            new AllowedExceptionListCatcher([]),
        ];
    }

    public function getMaxCount(): int
    {
        return 100;
    }


    public function fuzz(string $text)
    {

        dump($text);
        if ($text[5] != 'a') {
            throw new Exception('min than 50');
        }
    }

}
