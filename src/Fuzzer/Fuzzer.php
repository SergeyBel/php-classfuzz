<?php

namespace PhpClassFuzz\Fuzzer;

use PhpClassFuzz\Context\Context;
use PhpClassFuzz\Corpus\CorpusEndException;
use PhpClassFuzz\ExceptionCatcher\ExceptionCatcherManager;
use PhpClassFuzz\Fuzz\FuzzInterface;
use PhpClassFuzz\Printer\Printer;
use Throwable;

class Fuzzer
{
    public function __construct(
        private FuzzCaller $fuzzCaller,
        private ExceptionCatcherManager $exceptionCatcherManager,
        private Printer $printer
    ) {
    }

    public function runFuzzing(FuzzInterface $fuzzClass)
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
            try {
                $this->fuzzCaller->runFuzzCase($fuzzClass, $args);
            } catch (Throwable $e) {
                if (!$this->exceptionCatcherManager->canIgnoreException($fuzzClass, $e)) {
                    $this->printer->printException($e, $fuzzClass, $args);
                    return;
                }
            }
            $runCount++;
        }
    }
}
