<?php

namespace PhpClassFuzz\Runner;

use PhpClassFuzz\ClassWork\FuzzCaller;
use PhpClassFuzz\ClassWork\FuzzClassFinder;
use PhpClassFuzz\ClassWork\MethodAnalyzer;
use PhpClassFuzz\File\FuzzFileFinder;

class Runner
{
    public function __construct(
        private FuzzFileFinder $fuzzFileFinder,
        private FuzzClassFinder $fuzzClassFinder,
        private MethodAnalyzer $methodAnalyzer,
        private FuzzCaller $fuzzCaller
    ) {
    }
    public function runAllFuzz(RunnerConfiguration $configuration)
    {
        $files = $this->fuzzFileFinder->findFuzzFiles($configuration->getDirectory());
        $fuzzClasses = $this->fuzzClassFinder->findFuzzClasses($files);

        foreach ($fuzzClasses as $fuzzClass) {
            $argsGenerators = $this->methodAnalyzer->analyze($fuzzClass);

            for ($runCount = 0; $runCount < $configuration->getRunCount(); $runCount++) {
                $this->fuzzCaller->runFuzzCase($fuzzClass, $argsGenerators);
            }
        }
    }
}
