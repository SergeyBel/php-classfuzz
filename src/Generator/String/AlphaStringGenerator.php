<?php

namespace PhpClassFuzz\Generator\String;

use PhpClassFuzz\Generator\GeneratorInterface;

class AlphaStringGenerator implements GeneratorInterface
{
    private int $minLength;
    private int $maxLength;


    public function __construct(int $minLength = 0, int $maxLength = 25)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }


    public function generate(): string
    {
        $alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = random_int($this->minLength, $this->maxLength);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $alphabet[random_int(0, strlen($alphabet) - 1)];
        }
        return $str;
    }
}
