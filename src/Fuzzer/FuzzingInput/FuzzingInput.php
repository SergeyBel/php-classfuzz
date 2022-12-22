<?php

namespace PhpClassFuzz\Fuzzer\FuzzingInput;

use PhpClassFuzz\Argument\Input;
use PhpClassFuzz\Coverage\LineCoverageData;

class FuzzingInput
{
    public function __construct(
        public Input $input,
        public LineCoverageData $coverage
    ) {
    }
}
