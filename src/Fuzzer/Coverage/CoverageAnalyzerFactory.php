<?php

namespace PhpClassFuzz\Fuzzer\Coverage;

class CoverageAnalyzerFactory
{
    public function __construct(
        private CoverageExplorer $coverageAnalyzer,
        private CoverageEmptyExplorer $coverageEmptyAnalyzer
    ) {
    }

    public function getCoverageAnalyzer(bool $needCoverage): CoverageExplorerInterface
    {
        if ($needCoverage) {
            return $this->coverageAnalyzer;
        } else {
            return $this->coverageEmptyAnalyzer;
        }
    }
}
