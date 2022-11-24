<?php

namespace PhpClassFuzz\Random;

class Random
{
    public function getInt(int $min, int $max): int
    {
        return random_int($min, $max);
    }

    public function getBool(): bool
    {
        return $this->getInt(0, 1) == 1;
    }

    public function getFromArray(array $data): mixed {
        return array_rand($data);
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
    public function getFromArray1(array $data, int $length): array
    {
        $randomValues = [];
        for ($i = 0; $i < $length; $i++) {
            $randomValues[] = $data[array_rand($data)];
        }

        return $randomValues;
    }
}
