<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Corpus\Facade\CorpusGeneratorFacade;
use PhpClassFuzz\Corpus\Generator\CharStringCorpus;
use PhpClassFuzz\Fuzz\BaseFuzz;
use PhpClassFuzz\ExceptionCatcher\Catcher\AllowedExceptionListCatcher;
use PhpClassFuzz\Mutator\Facade\StringMutatorFacade;

class SimpleFuzz extends BaseFuzz
{
    public function getArgument(): Argument
    {
        $argument = new Argument(
            CorpusGeneratorFacade::getGenerator(CharStringCorpus::class)->generate(100),
            StringMutatorFacade::getAllMutators(),
        );

        return $argument;
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
        return 1000;
    }


    public function fuzz(string $input)
    {
        if (strlen($input) > 15) {
            throw new Exception();
        }
    }
}
