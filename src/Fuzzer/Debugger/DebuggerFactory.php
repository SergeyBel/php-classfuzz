<?php
namespace PhpClassFuzz\Fuzzer\Debugger;


class DebuggerFactory
{

    public function __construct(
        private Debugger $debugger,
        private DebuggerEmpty $debuggerEmpty
    )
    {
    }

    public function getDebugger(bool $isDebug): DebuggerInterface
    {
        if ($isDebug) {
            return $this->debugger;
        } else {
            return $this->debuggerEmpty;
        }

    }

}
