<?php


use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Generator\StringGenerator;

class SimpleFuzz implements FuzzInterface
{

    public function getGenerators()
    {
        return [StringGenerator::class];
    }

    public function fuzz(string $gen)
    {

        echo "Generated: ".$gen."\n";
    }

}
