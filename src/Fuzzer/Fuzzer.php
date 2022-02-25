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
            } catch (CorpusEndException) {
                echo "Corpus ended\n";
                break ;
            }
        }

        echo "Fuzzing finished $runCount inputs\n";
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
