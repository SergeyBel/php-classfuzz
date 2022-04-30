<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Corpus\Generator\DictionaryCorpus;
use PhpClassFuzz\Fuzz\BaseFuzz;
use PhpClassFuzz\Mutator\Facade\StringMutatorFacade;

class CssParserFuzz extends BaseFuzz
{
    public function getArgument(): Argument
    {
        $argument = new Argument(
            (new DictionaryCorpus(
                ['{','}','.', ',', '%', 's', '\\', '/', 'a', 'b', 'c', ':', ';', '!', '#', 'import', '@'],
                25
            ))->generate(100),
            StringMutatorFacade::getAllMutators(),
        );

        return $argument;
    }

    public function ignoreThrowable(\Throwable $throwable): bool
    {
        return false;
    }


    public function getMaxCount(): int
    {
        return 100;
    }

    public function getCoveragePath(): ?string
    {
        return __DIR__. '/../../vendor/sabberworm/php-css-parser';
    }


    public function fuzz(string $text)
    {
        $parser = new Sabberworm\CSS\Parser($text);
        $parser->parse();
    }
}
