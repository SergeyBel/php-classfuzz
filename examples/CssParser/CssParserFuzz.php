<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Corpus\Facade\CorpusGeneratorFacade;
use PhpClassFuzz\Corpus\Generator\DictionaryCorpus;
use PhpClassFuzz\Fuzz\BaseFuzz;
use PhpClassFuzz\ExceptionCatcher\Catcher\AllowedExceptionListCatcher;
use PhpClassFuzz\Mutator\Facade\StringMutatorFacade;

class CssParserFuzz extends BaseFuzz
{
    public function getArguments(): Argument
    {
        $argument = new Argument(
            CorpusGeneratorFacade::getGenerator(DictionaryCorpus::class)
                ->setDictionary(['{','}','.', ',', '%', 's', '\\', '/', 'a', 'b', 'c', ':', ';', '!', '#'])
                ->setMaxLen(25)
                ->generate(10000),
            StringMutatorFacade::getAllMutators(),
        );

        return $argument
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
        $parser = new Sabberworm\CSS\Parser($text);
        $parser->parse();
    }
}
