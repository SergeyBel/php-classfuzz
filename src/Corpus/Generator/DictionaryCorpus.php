<?php

namespace PhpClassFuzz\Corpus\Generator;

use PhpClassFuzz\Collection\Corpus;

class DictionaryCorpus
{
    public function generate(int $count, array $dictionary, ?int $maxLen = null): Corpus
    {
        $max = $maxLen ?? count($dictionary);
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $length = random_int(0, $max);
            $str = '';
            for ($j = 0; $j < $length; $j++) {
                $str .= $dictionary[array_rand($dictionary)];
            }
            $data[] = $str;
        }
        return new Corpus($data);
    }
}
