<?php


use PhpClassFuzz\Corpus\Corpus;
use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Mutator\Mutator\String\InsertCharMutator;
use PhpClassFuzz\Mutator\Mutators;
use \PhpClassFuzz\ExceptionCatcher\Catcher\AllowedExceptionListCatcher;


class SimpleFuzz implements FuzzInterface
{
    public function getCorpus(): Corpus
    {
        return new Corpus([
            ['123', '456']
        ]);
    }

    public function getMutators(): Mutators
    {
        return new Mutators([
            [new InsertCharMutator()]
        ]);
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
        /*if ($text[5] != 'a') {
            throw new Exception('min than 50');
        }*/
    }

}
