<?php

namespace PhpClassFuzz\Fuzzer\Debugger;

use PhpClassFuzz\Debug\Debug;

class Debugger implements DebuggerInterface
{
    public function __construct(
        private Debug $debug
    ) {
    }
    public function debug(mixed $value): void
    {
        $this->debug->debugPrint($value);
    }
}
