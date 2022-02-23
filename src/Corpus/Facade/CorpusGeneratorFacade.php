<?php

namespace PhpClassFuzz\Corpus\Facade;

use PhpClassFuzz\Corpus\Generator\GeneratorInterface;
use PhpClassFuzz\DependencyInjection\DependencyInjection;

class CorpusGeneratorFacade
{
    public static function getGenerator(string $className): GeneratorInterface
    {
        $builder = new DependencyInjection();
        $container = $builder->compileContainer();
        return $container->get($className);
    }
}
