<?php

namespace PhpClassFuzz\Random;

class Random
{
    public function getInt(int $max, int $min): int
    {
        return random_int($max, $min);
    }

    public function getChar(): string
    {
        return chr($this->getInt(0, 255));
    }

    public function getFromArray(array $data, int $length): array
    {
        $randomValues = [];
        for ($i = 0; $i < $length; $i++) {
            $randomValues[] = $data[array_rand($data)];
        }

        return $randomValues;
    }
}
