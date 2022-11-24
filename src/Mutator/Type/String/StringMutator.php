<?php

namespace PhpClassFuzz\Mutator\Type\String;

use PhpClassFuzz\DependencyInjection\DependencyInjection;
use PhpClassFuzz\Random\Random;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StringMutator
{
    public function __construct(
        private Random $random,
        private ContainerInterface $container
    ) {
    }

    public function mutate(string $str): string
    {
        $mutators = $this->getAllMutators();
        /** @var StringMutatorInterface $mutator */
        $mutator = $this->random->getFromArray($mutators);
        return $mutator->mutate($str);
    }

    /**
     * @return array<StringMutatorInterface>
     */
    private function getAllMutators(): array
    {
        $builder = new DependencyInjection();
        ;
        $services = $builder->getServicesByTag($this->container, 'fuzz.mutator.string');
        return $services;
    }
}
