<?php


use PhpClassFuzz\ExceptionCatcher\AllowedExceptionListCatcher;
use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Generator\String\AlphaStringGenerator;



class SimpleFuzz implements FuzzInterface
{

    public function getGenerators()
    {
        return [
            new AlphaStringGenerator(),
        ];
    }

    public function getExceptionCatchers()
    {
        return [
            new AllowedExceptionListCatcher([Exception::class]),
        ];
    }

    public function fuzz(string $text)
    {
        if ($text[5] != 'a') {
            throw new Exception('min than 50');
        }
    }

}
