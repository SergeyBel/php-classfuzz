<?php

namespace PhpClassFuzz\Generator\String;

use PhpClassFuzz\Generator\GeneratorInterface;

class AlphaStringGenerator implements GeneratorInterface
{
    private int $minLength;
    private int $maxLength;


    public function __construct(int $minLength = 0, int $maxLength = 100)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }


    public function generate(): string
    {
        $alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = $this->minLength; $i < $this->maxLength; $i++) {
            $str .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }
        return $str;
    }

}
