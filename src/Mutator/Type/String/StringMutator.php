<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\DependencyInjection\DependencyInjection;
use PhpClassFuzz\Mutator\Type\String\Mutator\InsertCharStringMutator;
use PhpClassFuzz\Random\Random;

class StringMutator
{

    public function __construct(
        private Random $random
    )
    {
    }

    public function mutate(string $str): string
    {
        $mutator = new InsertCharStringMutator();
        return $mutator->mutate($str);


    }

    /**
     * @return array<StringMutatorInterface>
     */
    private function getAllMutators(): array
    {
        $builder = new DependencyInjection();
        $container = $builder->compileContainer();
        $services = $builder->getServicesByTag($container, 'fuzz.mutator.string');
        return $services;
    }

}
