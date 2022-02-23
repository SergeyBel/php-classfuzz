<?php

namespace PhpClassFuzz\Mutator\Facade;

use PhpClassFuzz\Collection\Mutators;
use PhpClassFuzz\DependencyInjection\DependencyInjection;

class StringMutatorFacade
{
    public static function getAllMutators(): Mutators
    {
        $builder = new DependencyInjection();
        $container = $builder->compileContainer();
        $services = $builder->getServicesByTag($container, 'fuzz.mutator.string');
        return new Mutators($services);
    }
}
