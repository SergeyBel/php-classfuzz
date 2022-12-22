<?php
namespace PhpClassFuzz\Fuzzer\Debugger;

interface DebuggerInterface
{
    public function debug(mixed $value): void;


}
