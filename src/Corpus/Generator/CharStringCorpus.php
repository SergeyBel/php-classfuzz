<?php

namespace PhpClassFuzz\Corpus\Generator;

use PhpClassFuzz\Collection\Corpus;
use PhpClassFuzz\Random\Random;

class CharStringCorpus implements GeneratorInterface
{
    private int $minLength;

    private int $maxLength;

    private Random $random;

    public function __construct(
        int $minLength = 0,
        int $maxLength = 25
    ) {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
        $this->random = new Random();
    }


    public function generate(int $count): Corpus
    {
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $length = $this->random->getInt($this->minLength, $this->maxLength);
            $str = '';
            for ($j = 0; $j < $length; $j++) {
                $str .= $this->random->getSymbol();
            }
            $data[] = $str;
        }
        return new Corpus($data);
    }
}
