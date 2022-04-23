<?php

namespace PhpClassFuzz\Random;

class Random
{
    public function getInt(int $max, int $min): int
    {
        return random_int($max, $min);
    }

    public function getSymbol(): string
    {
        $characters = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
        $position = $this->getInt(0, strlen($characters) - 1);
        return $characters[$position];
    }

    /**
     * @param mixed[] $data
     * @return mixed[]
     */
    public function getFromArray(array $data, int $length): array
    {
        $randomValues = [];
        for ($i = 0; $i < $length; $i++) {
            $randomValues[] = $data[array_rand($data)];
        }

        return $randomValues;
    }
}
