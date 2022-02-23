<?php

namespace PhpClassFuzz\Debug;

class Debug
{
    public function debugPrint($data)
    {
        echo dump($data);
    }

}
