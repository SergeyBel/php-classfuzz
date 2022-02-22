<?php

namespace PhpClassFuzz\Generator\String;

use PhpClassFuzz\Generator\GeneratorInterface;

class CharStringGenerator implements GeneratorInterface
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
        $length = random_int($this->minLength, $this->maxLength);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= chr(random_int(0, 255));
        }
        return $str;
    }
}
