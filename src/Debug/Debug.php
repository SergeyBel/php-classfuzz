<?php

namespace PhpClassFuzz\Debug;

class Debug
{
    public function debugPrint(mixed $input): void
    {
        echo print_r($input, true)."\n";

    }
}
