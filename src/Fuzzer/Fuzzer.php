<?php

namespace PhpClassFuzz\Fuzzer;

use PhpClassFuzz\Context\Context;
use PhpClassFuzz\Corpus\CorpusEndException;
use PhpClassFuzz\Debug\Debug;
use PhpClassFuzz\ExceptionCatcher\ExceptionCatcherManager;
use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Printer\Printer;
use Throwable;

class Fuzzer
{
    public function __construct(
        private FuzzCaller $fuzzCaller,
        private ExceptionCatcherManager $exceptionCatcherManager,
        private Printer $printer,
        private Debug $debug
    ) {
    }

    public function runFuzzing(FuzzInterface $fuzzClass, bool $isDebug)
    {
        Context::setFuzzClassName(get_class($fuzzClass));
        $arguments = $fuzzClass->getArguments();
        $maxCount = $fuzzClass->getMaxCount();
        $runCount = 0;
        while ($runCount < $maxCount) {
            $args = [];
            foreach ($arguments->getArguments() as $argument) {
                try {
                    $corpusItem = $argument->getCorpus()->getNextCorpusItem();
                } catch (CorpusEndException) {
                    return;
                }

                $mutator = $argument->getMutators()->getNextMutator();
                $args[] = $mutator->mutate($corpusItem);
            }
            Context::setArgs($args);
            if ($isDebug) {
                $this->debug->debugPrint($args);
            }
            try {
                $callResult = $this->fuzzCaller->runFuzzCase($fuzzClass, $args);
                if (!$this->checkPostConditions($fuzzClass->getPostConditions(), $callResult)) {
                    return;
                }
            } catch (Throwable $e) {
                if (!$this->exceptionCatcherManager->canIgnoreException($fuzzClass, $e)) {
                    $this->printer->printException($e);
                    return;
                }
            }
            $runCount++;
        }
    }

    private function checkPostConditions(array $postConditions, $callResult): bool
    {
        foreach ($postConditions as $postCondition) {
            if (!$postCondition->checkPostCondition($callResult)) {
                $this->printer->printPostCondition($postCondition, $callResult);
                return false;
            }
        }

        return true;
    }
}
