<?php

namespace PhpClassFuzz\Fuzzer;

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
        $corpus = $fuzzClass->getCorpus();
        $mutators = $fuzzClass->getMutators();
        $maxCount = $fuzzClass->getMaxCount();
        $runCount = 0;
        while ($runCount < $maxCount) {
            $corpusItem = $corpus->getNextCorpusItem();
            foreach ($mutators->getMutators() as $argsMutators) {
                $args = [];
                foreach ($argsMutators as $key => $mutator) {
                    $args[$key] = $mutator->mutate($corpusItem[$key]);
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
}
