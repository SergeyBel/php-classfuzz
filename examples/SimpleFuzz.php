<?php


use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Generator\String\AlphaStringGenerator;
use PhpClassFuzz\Generator\String\CharStringGenerator;

class SimpleFuzz implements FuzzInterface
{

    public function getGenerators()
    {
        return [
            new AlphaStringGenerator(),
        ];
    }

    public function fuzz(string $gen)
    {

        echo "Generated: ".$gen."\n";
    }

}
