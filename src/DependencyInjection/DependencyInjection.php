<?php

namespace PhpClassFuzz\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class DependencyInjection
{
    public function compileContainer(): ContainerInterface
    {
        $containerBuilder = new ContainerBuilder();
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/../Config'));
        $loader->load('services.yaml');
        $containerBuilder->compile();
        return $containerBuilder;
    }

    public function getServicesByTag(ContainerInterface $container, string $tag): array
    {
        $services = [];
        foreach ($container->findTaggedServiceIds($tag) as $className => $definition) {
            $services[] = $container->get($className);
        }

        return $services;
    }
}
