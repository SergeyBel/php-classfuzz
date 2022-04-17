<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Corpus\Generator\CharStringCorpus;
use PhpClassFuzz\Fuzz\BaseFuzz;
use PhpClassFuzz\Mutator\Facade\StringMutatorFacade;

class SimpleFuzz extends BaseFuzz
{
    public function getArgument(): Argument
    {
        $argument = new Argument(
            (new CharStringCorpus())->generate(100),
            StringMutatorFacade::getAllMutators(),
        );

        return $argument;
    }

    public function ignoreThrowable(\Throwable $throwable): bool
    {
        return false;
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
