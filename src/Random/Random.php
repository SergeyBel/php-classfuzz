<?php

namespace PhpClassFuzz\Random;

class Random
{
    public function getInt(int $min, int $max): int
    {
        return random_int($min, $max);
    }

    /**
     * @param array<mixed> $data
     */
    public function getFromArray(array $data): mixed
    {
        return $data[array_rand($data)];
    }

    public function getSymbol(): string
    {
        $characters = '!"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';
        $position = $this->getInt(0, strlen($characters) - 1);
        return $characters[$position];
    }
}
