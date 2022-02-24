<?php

namespace PhpClassFuzz\Debug;

class Debug
{
    public function debugPrint($data)
    {
        echo print_r($data, 1)."\n";
    }
}
