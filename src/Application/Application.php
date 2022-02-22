<?php

namespace PhpClassFuzz\Application;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Application extends BaseApplication
{
    public function registerCommands(): void
    {
        $containerBuilder = new ContainerBuilder();
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__.'/../Config'));
        $loader->load('services.yaml');
        $containerBuilder->compile();

        foreach ($containerBuilder->findTaggedServiceIds('console.command') as $command => $definition) {
            $this->add($containerBuilder->get($command));
        }
    }
}
