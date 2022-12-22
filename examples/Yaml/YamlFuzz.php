<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Argument\Input;
use PhpClassFuzz\Fuzz\BaseFuzz;
use Symfony\Component\Yaml\Yaml;

class YamlFuzz extends BaseFuzz
{
    public function getInputs(): array
    {
        return [
           new Input(
               [new Argument(
                   [
                   'key1' => [
                       'key2' => 'value'
                   ]
               ]
               )
           ]
           ),
       ];
    }

    public function getMaxCount(): ?int
    {
        return 250;
    }

    public function getCoveragePath(): ?string
    {
        return __DIR__. '/../../vendor/symfony/yaml';
    }

    public function metPostCondition(Input $input, mixed $callResult): bool
    {
        return $callResult == $input->arguments[0]->value;
    }


    public function fuzz(Input $input)
    {
        $value = Yaml::parse(Yaml::dump($input->arguments[0]->value));
        return $value;
    }
}
