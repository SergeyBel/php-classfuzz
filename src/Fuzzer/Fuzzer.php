<?php

namespace PhpClassFuzz\Fuzzer;

use PhpClassFuzz\Coverage\Coverage;
use PhpClassFuzz\Coverage\LineCoverageAnalyzer;
use PhpClassFuzz\Coverage\LineCoverageData;
use PhpClassFuzz\Debug\Debug;

use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Fuzzer\FuzzingInput\FuzzingInput;
use PhpClassFuzz\Fuzzer\FuzzingInput\FuzzingInputQueue;
use PhpClassFuzz\Fuzzer\Result\FuzzingExceptionResult;
use PhpClassFuzz\Fuzzer\Result\FuzzingFinishedResult;
use PhpClassFuzz\Fuzzer\Result\FuzzingPostConditionViolationResult;
use PhpClassFuzz\Fuzzer\Result\FuzzingResultInterface;
use PhpClassFuzz\Mutator\InputMutator;
use PhpClassFuzz\PostCondition\PostConditionManager;
use PhpClassFuzz\ThrowableCatcher\ExceptionCatcherManager;
use PhpClassFuzz\Argument\Input;
use Throwable;

class Fuzzer
{
    public function __construct(
        private FuzzCaller $fuzzCaller,
        private ExceptionCatcherManager $exceptionCatcherManager,
        private PostConditionManager $postConditionManager,
        private Debug $debug,
        private Coverage $coverage,
        private LineCoverageAnalyzer $coverageAnalyzer,
        private InputMutator $inputMutator
    ) {
    }

    public function runFuzzing(FuzzInterface $fuzzClass, bool $isDebug): FuzzingResultInterface
    {
        $maxCount = $fuzzClass->getMaxCount();
        $needCoverage = !empty($fuzzClass->getCoveragePath());
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

        while (!$this->isFinished($runCount, $maxCount) && !$inputQueue->isEmpty()) {
            $newInput = $inputQueue->pop();
            $newInputParentCoverage = $newInput->coverage;
            $mutatedInputs = $this->inputMutator->mutateInput($newInput->input);

            foreach ($mutatedInputs as $input) {
                if ($needCoverage) {
                    $this->coverage->start($fuzzClass->getCoveragePath());
                }

                if ($isDebug) {
                    $this->debugPrintInput($input);
                }

                if ($result = $this->runOneInput($fuzzClass, $input)) {
                    return $result;
                }

                $runCount++;
                if ($needCoverage) {
                    $this->analyzeCoverage($input, $inputQueue, $currentCoverage, $newInputParentCoverage);
                    if ($isDebug) {
                        $this->debug->debugPrint('total coverage lines '. $currentCoverage->totalLines());
                    }
                }
            }
        }

        if ($needCoverage) {
            if ($isDebug) {
                $this->debug->debugPrint('generate coverage report');
                $this->coverage->saveHtmlReport();
            }
        }
        return new FuzzingFinishedResult($runCount);
    }

    private function isFinished(int $runCount, ?int $maxCount): bool
    {
        if ($maxCount === null) {
            return false;
        }
        return $runCount > $maxCount;
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

    private function analyzeCoverage(
        Input $input,
        FuzzingInputQueue $queue,
        LineCoverageData $currentCoverage,
        LineCoverageData $inputCoverage
    ): void {
        $this->coverage->stop();
        $actualCoverage = $this->coverage->getCoverageData();

        if ($this->coverageAnalyzer->hasNewLines($inputCoverage, $actualCoverage)) {
            $queue->push(new FuzzingInput(
                $input,
                $actualCoverage
            ));
            $currentCoverage->merge($actualCoverage);
        }
    }

    private function debugPrintInput(Input $input): void
    {
        $data = [];
        foreach ($input->arguments as $argument) {
            $data[] = $argument->value;
        }
        $this->debug->debugPrint($data);
    }
}
