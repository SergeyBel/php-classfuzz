<?php

namespace PhpClassFuzz\Fuzzer\Debugger;

class DebuggerEmpty implements DebuggerInterface
{
    public function debug(mixed $value): void
    {
        return;
    }


}
