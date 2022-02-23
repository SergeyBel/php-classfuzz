<?php

namespace PhpClassFuzz\Runner;

use PhpClassFuzz\File\FuzzClassFinder;
use PhpClassFuzz\File\FuzzFileFinder;
use PhpClassFuzz\Fuzzer\Fuzzer;

class Runner
{
    public function __construct(
        private FuzzFileFinder $fuzzFileFinder,
        private FuzzClassFinder $fuzzClassFinder,
        private Fuzzer $fuzzer,
    ) {
    }
    public function runAllFuzz(RunnerConfiguration $configuration)
    {
        $files = $this->fuzzFileFinder->findFuzzFiles($configuration->getDirectory());
        $fuzzClasses = $this->fuzzClassFinder->findFuzzClasses($files);


        $this->registerErrorhandler();
        foreach ($fuzzClasses as $fuzzClass) {
            $this->fuzzer->runFuzzing($fuzzClass);
        }
    }

    private function registerErrorhandler()
    {
        set_error_handler(
            function ($errno, $errstr, $errfile, $errline) {
                if (!(error_reporting() & $errno)) {
                    return true;
                }

                echo json_encode(
                    [
                        'errno' => $errno,
                        'errstr' => $errstr,
                        'errfile' => $errfile,
                        'errline' => $errline,
                    ]
                );
                exit(1);
            }
        );
    }
}
