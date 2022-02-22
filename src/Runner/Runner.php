<?php

namespace PhpClassFuzz\Runner;

use PhpClassFuzz\ClassWork\ExceptionCatcherManager;
use PhpClassFuzz\ClassWork\FuzzCaller;
use PhpClassFuzz\ClassWork\FuzzClassFinder;
use PhpClassFuzz\ClassWork\MethodAnalyzer;
use PhpClassFuzz\File\FuzzFileFinder;
use Throwable;

class Runner
{
    public function __construct(
        private FuzzFileFinder $fuzzFileFinder,
        private FuzzClassFinder $fuzzClassFinder,
        private MethodAnalyzer $methodAnalyzer,
        private ExceptionCatcherManager $exceptionCatcherManager,
        private FuzzCaller $fuzzCaller
    ) {
    }
    public function runAllFuzz(RunnerConfiguration $configuration)
    {
        $files = $this->fuzzFileFinder->findFuzzFiles($configuration->getDirectory());
        $fuzzClasses = $this->fuzzClassFinder->findFuzzClasses($files);


        $this->registerErrorhandler();
        foreach ($fuzzClasses as $fuzzClass) {
            $argsGenerators = $this->methodAnalyzer->analyze($fuzzClass);

            for ($runCount = 0; $runCount < $configuration->getRunCount(); $runCount++) {
                try {
                    $this->fuzzCaller->runFuzzCase($fuzzClass, $argsGenerators);
                } catch (Throwable $e) {
                    if (!$this->exceptionCatcherManager->canIgnoreException($fuzzClass, $e)) {
                        echo json_encode(['message' => 'exception error: '.$e->getMessage()]);
                        break;
                    }
                }
            }
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
