<?php

namespace PhpClassFuzz\Generator\String;

use PhpClassFuzz\Generator\GeneratorInterface;

class CharStringGenerator implements GeneratorInterface
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
        $str = '';
        for ($i = $this->minLength; $i < $this->maxLength; $i++) {
            $str .= chr(random_int(0, 255));
        }
        return $str;
    }
}
