<?php

namespace PhpClassFuzz\Runner;

use PhpClassFuzz\Exception\PhpErrorException;
use PhpClassFuzz\File\FuzzClassFinder;
use PhpClassFuzz\File\FuzzFileFinder;
use PhpClassFuzz\Fuzz\Result\FuzzingExceptionResult;
use PhpClassFuzz\Fuzz\Result\FuzzingFinishedResult;
use PhpClassFuzz\Fuzz\Result\FuzzingPostConditionViolationResult;
use PhpClassFuzz\Fuzz\Result\FuzzingResultInterface;
use PhpClassFuzz\Fuzzer\Fuzzer;
use PhpClassFuzz\Printer\Printer;
use Exception;

class Runner
{
    public function __construct(
        private FuzzFileFinder $fuzzFileFinder,
        private FuzzClassFinder $fuzzClassFinder,
        private Fuzzer $fuzzer,
        private Printer $printer
    ) {
    }
    public function runAllFuzz(RunnerConfiguration $configuration): void
    {
        $files = $this->fuzzFileFinder->findFuzzFiles($configuration->getDirectory());
        $fuzzClasses = $this->fuzzClassFinder->findFuzzClasses($files);


        $this->registerErrorhandler();
        foreach ($fuzzClasses as $fuzzClass) {
            $fuzzingResult = $this->fuzzer->runFuzzing($fuzzClass, $configuration->isDebug());
            $this->printResult($fuzzingResult);
        }
    }

    private function registerErrorhandler(): void
    {
        set_error_handler(
            function ($errno, $errstr, $errfile, $errline) {
                if (!(error_reporting() & $errno)) {
                    return true;
                }

                throw new PhpErrorException($errno, $errstr, $errfile, $errline);
            }
        );
    }

    private function printResult(FuzzingResultInterface $fuzzingResult): void
    {
        switch (get_class($fuzzingResult)) {
            case FuzzingFinishedResult::class:
                $this->printer->printFinished($fuzzingResult);
                break;

            case FuzzingExceptionResult::class:
                $this->printer->printException($fuzzingResult);
                break;

            case FuzzingPostConditionViolationResult::class:
                $this->printer->printPostCondition($fuzzingResult);
                break;

            default:
                throw new Exception('Unknown fuzzing result '. get_class($fuzzingResult));
        }
    }
}
