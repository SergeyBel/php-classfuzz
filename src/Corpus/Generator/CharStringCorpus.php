<?php

namespace PhpClassFuzz\Corpus\Generator;

use PhpClassFuzz\Corpus\Corpus;

class CharStringCorpus
{
    public function generate(int $count, int $minLength = 0, int $maxLength = 100): Corpus
    {
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $length = random_int($minLength, $maxLength);
            $str = '';
            for ($j = 0; $j < $length; $j++) {
                $str .= chr(random_int(0, 255));
            }
            $data[] = $str;
        }
        return new Corpus($data);
    }
}
