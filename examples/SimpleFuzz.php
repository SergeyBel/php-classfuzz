<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Argument\Arguments;
use PhpClassFuzz\Corpus\Generator\DictionaryCorpus;
use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Mutator\Mutator\String\DuplicatePartMutator;
use PhpClassFuzz\Mutator\Mutator\String\InsertCharMutator;
use PhpClassFuzz\Mutator\Mutators;
use \PhpClassFuzz\ExceptionCatcher\Catcher\AllowedExceptionListCatcher;



class SimpleFuzz implements FuzzInterface
{
    public function getArguments(): Arguments
    {
        $args = new Arguments();
        $args->setArgument(0, new Argument(
            (new DictionaryCorpus())->generate(
                10000,
                ['{','}','.', ',', '%', 's', '\\', '/', 'a', 'b', 'c', ':', ';', '!', '#'],
                25
            ),
            new Mutators([new InsertCharMutator(), new DuplicatePartMutator()])
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
        return 100000;
    }


    public function fuzz(string $text)
    {
        dump($text);
        $parser = new Sabberworm\CSS\Parser($text);
        $parser->parse();
    }

}
