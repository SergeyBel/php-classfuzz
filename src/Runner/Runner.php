<?php

namespace PhpClassFuzz\Runner;

use PhpClassFuzz\File\FuzzClassFinder;
use PhpClassFuzz\File\FuzzFileFinder;
use PhpClassFuzz\Fuzzer\Fuzzer;
use PhpClassFuzz\Printer\Printer;

class Runner
{
    public function __construct(
        private FuzzFileFinder $fuzzFileFinder,
        private FuzzClassFinder $fuzzClassFinder,
        private Fuzzer $fuzzer,
        private Printer $printer
    ) {
    }
    public function runAllFuzz(RunnerConfiguration $configuration)
    {
        $files = $this->fuzzFileFinder->findFuzzFiles($configuration->getDirectory());
        $fuzzClasses = $this->fuzzClassFinder->findFuzzClasses($files);


        $this->registerErrorhandler();
        foreach ($fuzzClasses as $fuzzClass) {
            $this->fuzzer->runFuzzing($fuzzClass, $configuration->isDebug());
        }
    }

    private function registerErrorhandler()
    {
        set_error_handler(
            function ($errno, $errstr, $errfile, $errline) {
                if (!(error_reporting() & $errno)) {
                    return true;
                }

                $this->printer->printPhpError($errno, $errstr, $errfile, $errline);

                exit(1);
            }
        );
    }
}
