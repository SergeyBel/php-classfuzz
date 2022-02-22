<?php

namespace PhpClassFuzz\ClassWork;

use Symfony\Component\DependencyInjection\ContainerInterface;

class MethodAnalyzer
{
    public const METHOD_NAME = 'fuzz';

    public function analyze(string $class): array
    {
        $generators = (new $class())->getGenerators();
        return $generators;
    }
}
