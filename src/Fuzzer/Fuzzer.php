<?php

namespace PhpClassFuzz\Fuzzer;

use PhpClassFuzz\Context\Context;
use PhpClassFuzz\Corpus\CorpusEndException;
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
                        if (!$this->postConditionManager->checkPostCondition($fuzzClass, $callResult)) {
                            return new FuzzingPostConditionViolationResult($fuzzClass, $input, $callResult);
                        }
                    } catch (Throwable $e) {
                        if (!$this->exceptionCatcherManager->canIgnoreThrowable($fuzzClass, $e)) {
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
}
