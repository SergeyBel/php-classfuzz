<?php

namespace PhpClassFuzz\Fuzzer;

use PhpClassFuzz\Coverage\LineCoverageData;

use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Fuzzer\Coverage\CoverageAnalyzerFactory;
use PhpClassFuzz\Fuzzer\Debugger\DebuggerFactory;
use PhpClassFuzz\Fuzzer\Debugger\DebuggerInterface;
use PhpClassFuzz\Fuzzer\FuzzingInput\FuzzingInput;
use PhpClassFuzz\Fuzzer\FuzzingInput\FuzzingInputQueue;
use PhpClassFuzz\Fuzzer\Result\FuzzingExceptionResult;
use PhpClassFuzz\Fuzzer\Result\FuzzingFinishedResult;
use PhpClassFuzz\Fuzzer\Result\FuzzingPostConditionViolationResult;
use PhpClassFuzz\Fuzzer\Result\FuzzingResultInterface;
use PhpClassFuzz\Mutator\InputMutator;
use PhpClassFuzz\PostCondition\PostConditionManager;
use PhpClassFuzz\Runner\Configuration\RunnerConfiguration;
use PhpClassFuzz\ThrowableCatcher\ExceptionCatcherManager;
use PhpClassFuzz\Argument\Input;
use Throwable;

class Fuzzer
{
    public function __construct(
        private FuzzCaller $fuzzCaller,
        private ExceptionCatcherManager $exceptionCatcherManager,
        private PostConditionManager $postConditionManager,
        private InputMutator $inputMutator,
        private CoverageAnalyzerFactory $coverageFactory,
        private DebuggerFactory $debuggerFactory
    ) {
    }

    public function runFuzzing(FuzzInterface $fuzzClass, RunnerConfiguration $configuration): FuzzingResultInterface
    {
        $coverage = $this->coverageFactory->getCoverageAnalyzer(!empty($fuzzClass->getCoveragePath()));
        $debugger = $this->debuggerFactory->getDebugger($configuration->isDebug);
        $runCount = 0;
        $inputQueue = new FuzzingInputQueue();
        $currentCoverage = new LineCoverageData();

        foreach ($fuzzClass->getInputs() as $input) {
            $inputQueue->push(
                new FuzzingInput(
                    $input,
                    new LineCoverageData()
                )
            );
        }

        while (!$inputQueue->isEmpty()) {
            $newInput = $inputQueue->pop();
            $mutatedInputs = $this->inputMutator->mutateInput($newInput->input);

            foreach ($mutatedInputs as $input) {
                if ($this->isFinished($runCount, $fuzzClass->getMaxCount())) {
                    break 2;
                }

                $coverage->start($fuzzClass->getCoveragePath() ?? '');
                $this->debugPrintInput($debugger, $input);
                if ($result = $this->runOneInput($fuzzClass, $input)) {
                    return $result;
                }
                $runCount++;


                $actualCoverage = $coverage->explore($newInput->coverage);
                $inputQueue->push(
                    new FuzzingInput(
                            $input,
                            $actualCoverage
                        )
                );
                $currentCoverage->merge($actualCoverage);

                $debugger->debug('total coverage lines '. $currentCoverage->totalLines());
            }
        }


        $debugger->debug('generate coverage report');
        $coverage->saveReport();

        return new FuzzingFinishedResult($runCount);
    }

    private function isFinished(int $runCount, ?int $maxCount): bool
    {
        if ($maxCount === null) {
            return false;
        }
        return $runCount >= $maxCount;
    }

    private function runOneInput(FuzzInterface $fuzzClass, Input $input): ?FuzzingResultInterface
    {
        try {
            $callResult = $this->fuzzCaller->runFuzzCase($fuzzClass, $input);
            if (!$this->postConditionManager->checkPostCondition($fuzzClass, $callResult)) {
                return new FuzzingPostConditionViolationResult($fuzzClass, $input, $callResult);
            }
        } catch (Throwable $e) {
            if (!$this->exceptionCatcherManager->canIgnoreThrowable($fuzzClass, $e)) {
                return new FuzzingExceptionResult($fuzzClass, $e, $input);
            }
        }

        return null;
    }


    private function debugPrintInput(DebuggerInterface $debugger, Input $input): void
    {
        $data = [];
        foreach ($input->arguments as $argument) {
            $data[] = $argument->value;
        }
        $debugger->debug($data);
    }
}
