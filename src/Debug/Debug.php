<?php

namespace PhpClassFuzz\Debug;

class Debug
{
    public function debugPrint($input)
    {
        echo print_r($input, 1)."\n";
    }
}
