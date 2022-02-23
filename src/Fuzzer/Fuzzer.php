<?php

namespace PhpClassFuzz\Fuzzer;

use PhpClassFuzz\Corpus\CorpusEndException;
use PhpClassFuzz\ExceptionCatcher\ExceptionCatcherManager;
use PhpClassFuzz\Fuzz\FuzzInterface;
use Throwable;

class Fuzzer
{
    public function __construct(
        private FuzzCaller $fuzzCaller,
        private ExceptionCatcherManager $exceptionCatcherManager
    ) {
    }

    public function runFuzzing(FuzzInterface $fuzzClass)
    {
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
            try {
                $this->fuzzCaller->runFuzzCase($fuzzClass, $args);
            } catch (Throwable $e) {
                if (!$this->exceptionCatcherManager->canIgnoreException($fuzzClass, $e)) {
                    echo json_encode(['message' => 'exception error: ' . $e->getMessage()]);
                    return;
                }
            }
            $runCount++;
        }
    }
}
