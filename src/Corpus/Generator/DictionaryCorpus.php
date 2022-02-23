<?php

namespace PhpClassFuzz\Corpus\Generator;

use PhpClassFuzz\Collection\Corpus;
use PhpClassFuzz\Random\Random;

class DictionaryCorpus implements GeneratorInterface
{
    private array $dictionary;
    private ?int $maxLen;

    public function __construct(
        private Random $random
    ) {
    }


    public function generate(int $count): Corpus
    {
        $max = $this->maxLen ?? count($this->dictionary);
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $length = $this->random->getInt(0, $max);
            $str = implode($this->random->getFromArray($this->dictionary, $length));
            $data[] = $str;
        }
        return new Corpus($data);
    }


    public function setDictionary(array $dictionary): self
    {
        $this->dictionary = $dictionary;
        return $this;
    }


    public function setMaxLen(?int $maxLen): self
    {
        $this->maxLen = $maxLen;
        return $this;
    }
}
