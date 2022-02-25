<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Argument\Arguments;
use PhpClassFuzz\Corpus\Facade\CorpusGeneratorFacade;
use PhpClassFuzz\Corpus\Generator\CharStringCorpus;
use PhpClassFuzz\Fuzz\BaseFuzz;
use PhpClassFuzz\ExceptionCatcher\Catcher\AllowedExceptionListCatcher;
use PhpClassFuzz\Mutator\Facade\StringMutatorFacade;

class SimpleFuzz extends BaseFuzz
{
    public function getArguments(): Arguments
    {
        $args = new Arguments();
        $args->setArgument(0, new Argument(
            CorpusGeneratorFacade::getGenerator(CharStringCorpus::class)->generate(100),
            StringMutatorFacade::getAllMutators(),
        ));

        return $args;
    }

    public function getExceptionCatchers(): array
    {
        return [
            new AllowedExceptionListCatcher([]),
        ];
    }

    public function getPostConditions(): array
    {
        return [

        ];
    }

    public function getMaxCount(): int
    {
        return 5000;
    }


    public function fuzz(string $text)
    {
        if (strlen($text) > 15) {
            throw new Exception();
        }
    }
}
