<?php

namespace PhpClassFuzz\Generator\String;

use PhpClassFuzz\Generator\GeneratorInterface;

class MbStringGenerator implements GeneratorInterface
{
    private int $minLength;

    private int $maxLength;

    private ?string $encoding;


    public function __construct(int $minLength = 0, int $maxLength = 100, ?string $encoding = null)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
        $this->encoding = $encoding;
    }


    public function generate(): string
    {
        $str = '';
        for ($i = $this->minLength; $i < $this->maxLength; $i++) {
            $char = mb_chr(random_int(0, 65535), $this->encoding);
            if ($char !== false) {
                $str.=$char;
            }
        }
        return $str;
    }
}
