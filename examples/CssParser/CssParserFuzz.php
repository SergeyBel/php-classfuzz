<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Corpus\Facade\CorpusGeneratorFacade;
use PhpClassFuzz\Corpus\Generator\DictionaryCorpus;
use PhpClassFuzz\Fuzz\BaseFuzz;
use PhpClassFuzz\ExceptionCatcher\Catcher\AllowedExceptionListCatcher;
use PhpClassFuzz\Mutator\Facade\StringMutatorFacade;

class CssParserFuzz extends BaseFuzz
{
    public function getArgument(): Argument
    {
        $argument = new Argument(
            (new DictionaryCorpus(
                ['{','}','.', ',', '%', 's', '\\', '/', 'a', 'b', 'c', ':', ';', '!', '#'],
                25
            ))->generate(100),
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

    public function getMaxCount(): int
    {
        return 100;
    }


    public function fuzz(string $text)
    {
        $parser = new Sabberworm\CSS\Parser($text);
        $parser->parse();
    }
}
