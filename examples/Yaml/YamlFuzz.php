<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Argument\Input;
use PhpClassFuzz\Fuzz\BaseFuzz;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class YamlFuzz extends BaseFuzz
{
    public function getInputs(): array
    {
        return [
           new Input([new Argument('1234')]),
       ];
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


    public function fuzz(Input $input)
    {
        $value = Yaml::parse($input->arguments[0]->value);
        return $value;
    }
}
