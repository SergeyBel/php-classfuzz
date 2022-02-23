<?php

namespace PhpClassFuzz\Fuzzer;

class FuzzCaller
{
    public const METHOD_NAME = 'fuzz';

    public function runFuzzCase($fuzzClass, array $args)
    {
        call_user_func_array([$fuzzClass, self::METHOD_NAME], $args);
    }
}
