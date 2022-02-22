<?php

namespace PhpClassFuzz\ClassWork;

use Symfony\Component\DependencyInjection\ContainerInterface;

class MethodAnalyzer
{
    public const METHOD_NAME = 'fuzz';

    public function __construct(
        private ContainerInterface $container
    ) {
    }

    public function analyze(string $class): array
    {
        $generatorsNames = (new $class())->getGenerators();
        $generators = [];
        foreach ($generatorsNames as $generatorName) {
            $generators[] = $this->container->get($generatorName);
        }
        return $generators;
    }
}
