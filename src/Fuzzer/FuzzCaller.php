<?php

namespace PhpClassFuzz\Fuzzer;

use PhpClassFuzz\Fuzz\FuzzInterface;

class FuzzCaller
{
    public const METHOD_NAME = 'fuzz';

    public function runFuzzCase(FuzzInterface $fuzzClass, mixed $input): mixed
    {
        return call_user_func_array([$fuzzClass, self::METHOD_NAME], [$input]);
    }
}
