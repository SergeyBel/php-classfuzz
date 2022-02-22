<?php

namespace PhpClassFuzz\ClassWork;

class FuzzCaller
{
    public function runFuzzCase(string $fuzzClass, array $argsGenerators)
    {
        $class = new $fuzzClass();
        $args = [];
        foreach ($argsGenerators as $generator) {
            $args[] = $generator->generate();
        }

        call_user_func_array([$class, MethodAnalyzer::METHOD_NAME], $args);
    }
}
