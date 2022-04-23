<?php

namespace PhpClassFuzz\Corpus\Generator;

use PhpClassFuzz\Collection\Corpus;
use PhpClassFuzz\Random\Random;

class DictionaryCorpus implements GeneratorInterface
{
    /**
     * @var string[]
     */
    private array $dictionary;
    private ?int $maxLength;
    private Random $random;


    /**
     * @param string[] $dictionary
     */
    public function __construct(
        array $dictionary,
        ?int $maxLength = null
    ) {
        $this->dictionary = $dictionary;
        $this->maxLength = $maxLength;
        $this->random = new Random();
    }


    public function generate(int $count): Corpus
    {
        $max = $this->maxLength ?? count($this->dictionary);
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $length = $this->random->getInt(0, $max);
            $str = implode($this->random->getFromArray($this->dictionary, $length));
            $data[] = $str;
        }
        return new Corpus($data);
    }
}
