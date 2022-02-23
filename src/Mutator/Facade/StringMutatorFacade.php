<?php

namespace PhpClassFuzz\Mutator\Facade;

use PhpClassFuzz\Collections\Mutators;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class StringMutatorFacade
{
    public static function getAllMutators(): Mutators
    {
        $containerBuilder = new ContainerBuilder();
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/../../Config'));
        $loader->load('services.yaml');
        $containerBuilder->compile();
        $a = [];
        foreach ($containerBuilder->findTaggedServiceIds('fuzz.mutator.string') as $command => $definition) {
            $a[] = $containerBuilder->get($command);
        }
        return new Mutators($a);
    }
}
