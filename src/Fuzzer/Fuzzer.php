<?php

namespace PhpClassFuzz\Fuzzer;

use PhpClassFuzz\Context\Context;
use PhpClassFuzz\Corpus\CorpusEndException;
use PhpClassFuzz\Debug\Debug;
use PhpClassFuzz\ExceptionCatcher\ExceptionCatcherManager;
use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Fuzz\Result\FuzzingExceptionResult;
use PhpClassFuzz\Fuzz\Result\FuzzingFinishedResult;
use PhpClassFuzz\Fuzz\Result\FuzzingPostConditionViolationResult;
use PhpClassFuzz\Fuzz\Result\FuzzingResultInterface;
use PhpClassFuzz\PostCondition\PostConditionInterface;
use Throwable;

class Fuzzer
{
    public function __construct(
        private FuzzCaller $fuzzCaller,
        private ExceptionCatcherManager $exceptionCatcherManager,
        private Debug $debug
    ) {
    }

    public function runFuzzing(FuzzInterface $fuzzClass, bool $isDebug): FuzzingResultInterface
    {
        Context::setFuzzClassName(get_class($fuzzClass));
        $argument = $fuzzClass->getArgument();
        $maxCount = $fuzzClass->getMaxCount();
        $runCount = 0;
        while ($runCount < $maxCount) {
            try {
                $corpusItem = $argument->getCorpus()->getNextCorpusItem();

                foreach ($argument->getMutators() as $mutator) {
                    $input = $mutator->mutate($corpusItem);

                    Context::setInput($input);
                    if ($isDebug) {
                        $this->debug->debugPrint($input);
                    }
                    try {
                        $callResult = $this->fuzzCaller->runFuzzCase($fuzzClass, $input);
                        if (($violatedPostCondition = $this->checkPostConditions($fuzzClass->getPostConditions(), $callResult)) !== true) {
                            return new FuzzingPostConditionViolationResult($fuzzClass, $violatedPostCondition, $input, $callResult);
                        }
                    } catch (Throwable $e) {
                        if (!$this->exceptionCatcherManager->canIgnoreException($fuzzClass, $e)) {
                            return new FuzzingExceptionResult($fuzzClass, $e, $input);
                        }
                    }

                    $runCount++;
                }
            } catch (CorpusEndException) {
                break ;
            }
        }

        return new FuzzingFinishedResult($fuzzClass, $runCount);
    }

    private function checkPostConditions(array $postConditions, $callResult): bool|PostConditionInterface
    {
        foreach ($postConditions as $postCondition) {
            if (!$postCondition->checkPostCondition($callResult)) {
                return $postCondition;
            }
        }

        return true;
    }
}
