<?php

namespace PhpClassFuzz\Mutator\Facade;

use PhpClassFuzz\DependencyInjection\DependencyInjection;
use PhpClassFuzz\Mutator\StringMutatorInterface;

class StringMutatorFacade
{
    /**
     * @return StringMutatorInterface[]
     */
    public static function getAllMutators(): array
    {
        $builder = new DependencyInjection();
        $container = $builder->compileContainer();
        $services = $builder->getServicesByTag($container, 'fuzz.mutator.string');
        return $services;
    }
}
