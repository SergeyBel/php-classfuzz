<?php

namespace PhpClassFuzz\Corpus\Generator;

use PhpClassFuzz\Collection\Corpus;
use PhpClassFuzz\Random\Random;

class CharStringCorpus implements GeneratorInterface
{
    private int $minLength;

    private int $maxLength;

    public function __construct(
        private Random $random
    ) {
    }


    public function generate(int $count): Corpus
    {
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $length = $this->random->getInt($this->minLength, $this->maxLength);
            $str = '';
            for ($j = 0; $j < $length; $j++) {
                $str .= $this->random->getChar();
            }
            $data[] = $str;
        }
        return new Corpus($data);
    }


    public function setMinLength(int $minLength): self
    {
        $this->minLength = $minLength;
        return $this;
    }


    public function setMaxLength(int $maxLength): self
    {
        $this->maxLength = $maxLength;
        return $this;
    }
}
