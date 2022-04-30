<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Corpus\Generator\DictionaryCorpus;
use PhpClassFuzz\Fuzz\BaseFuzz;
use PhpClassFuzz\Mutator\Facade\StringMutatorFacade;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class YamlFuzz extends BaseFuzz
{
    public function getArgument(): Argument
    {
        $argument = new Argument(
            (new DictionaryCorpus(
                ['key','value','1234','567',':',"\n",',',' ','- ',': >',': |', '<<', '!<foo>','!h!foo', '*',"'", '&','#', '[',']','-', '\\',],
                50
            ))->generate(2000),
            StringMutatorFacade::getAllMutators(),
        );

        return $argument;
    }

    public function ignoreThrowable(\Throwable $throwable): bool
    {
        $tc = get_class($throwable);
        if (in_array($tc, [ParseException::class])) {
            return true;
        }
        return false;
    }


    public function getMaxCount(): ?int
    {
        return null;
    }

    public function getCoveragePath(): ?string
    {
        return __DIR__. '/../../vendor/symfony/yaml';
    }

    public function metPostCondition(mixed $callResult): bool
    {
        return true;
    }


    public function fuzz(string $text)
    {
        $value = Yaml::parse($text);
        return $value;
    }
}
