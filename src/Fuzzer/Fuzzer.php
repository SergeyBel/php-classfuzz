<?php

namespace PhpClassFuzz\Fuzzer;

use PhpClassFuzz\Collection\InputQueue;
use PhpClassFuzz\Context\Context;
use PhpClassFuzz\Corpus\CorpusEndException;
use PhpClassFuzz\Coverage\Coverage;
use PhpClassFuzz\Coverage\LineCoverageAnalyzer;
use PhpClassFuzz\Coverage\LineCoverageData;
use PhpClassFuzz\Debug\Debug;

use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Fuzz\Result\FuzzingExceptionResult;
use PhpClassFuzz\Fuzz\Result\FuzzingFinishedResult;
use PhpClassFuzz\Fuzz\Result\FuzzingPostConditionViolationResult;
use PhpClassFuzz\Fuzz\Result\FuzzingResultInterface;
use PhpClassFuzz\PostCondition\PostConditionManager;
use PhpClassFuzz\ThrowableCatcher\ExceptionCatcherManager;
use Throwable;

class Fuzzer
{
    public function __construct(
        private FuzzCaller $fuzzCaller,
        private ExceptionCatcherManager $exceptionCatcherManager,
        private PostConditionManager $postConditionManager,
        private Debug $debug,
        private Coverage $coverage,
        private LineCoverageAnalyzer $coverageAnalyzer
    ) {
    }

    public function runFuzzing(FuzzInterface $fuzzClass, bool $isDebug): FuzzingResultInterface
    {
        Context::setFuzzClassName(get_class($fuzzClass));
        $argument = $fuzzClass->getArgument();
        $maxCount = $fuzzClass->getMaxCount();
        $needCoverage = !empty($fuzzClass->getCoveragePath());
        $runCount = 0;
        $inputQueue = new InputQueue();
        $currentCoverage = new LineCoverageData();

        while ($runCount < $maxCount) {
            if ($inputQueue->isEmpty()) {
                try {
                    $corpusItem = $argument->getCorpus()->getNextCorpusItem();
                    $inputQueue->push($corpusItem);
                } catch (CorpusEndException) {
                    break;
                }
            }

            $newInput = $inputQueue->pop();
            foreach ($argument->getMutators() as $mutator) {
                $input = $mutator->mutate($newInput);
                if ($needCoverage) {
                    $this->coverage->start($fuzzClass->getCoveragePath());
                }

                Context::setInput($input);
                if ($isDebug) {
                    $this->debug->debugPrint($input);
                }

                if ($result = $this->runOneInput($fuzzClass, $input)) {
                    return $result;
                }

                $runCount++;
                if ($needCoverage) {
                    $this->analyzeCoverage($input, $inputQueue, $currentCoverage);
                }
            }
        }

        return new FuzzingFinishedResult($fuzzClass, $runCount);
    }

    private function runOneInput(FuzzInterface $fuzzClass, $input): ?FuzzingResultInterface
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

    private function analyzeCoverage($input, InputQueue $queue, LineCoverageData $currentCoverage)
    {
        $this->coverage->stop();
        $actualCoverage = $this->coverage->getCoverageData();

        if ($this->coverageAnalyzer->hasNewLines($currentCoverage, $actualCoverage)) {
            $queue->push($input);
            $currentCoverage->merge($actualCoverage);
        }
    }
}
