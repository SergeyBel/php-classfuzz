<?php

namespace PhpClassFuzz\Fuzzer\Coverage;

use PhpClassFuzz\Coverage\Coverage;
use PhpClassFuzz\Coverage\LineCoverageAnalyzer;
use PhpClassFuzz\Coverage\LineCoverageData;

class CoverageExplorer implements CoverageExplorerInterface
{
    public function __construct(
        private Coverage $coverage,
        private LineCoverageAnalyzer $coverageAnalyzer,
    ) {
    }

    public function start(string $coveragePath): void
    {
        $this->coverage->start($coveragePath);
    }

    public function explore(LineCoverageData $oldCoverage): LineCoverageData
    {
        $this->coverage->stop();
        $actualCoverage = $this->coverage->getCoverageData();

        if ($this->coverageAnalyzer->hasNewLines($oldCoverage, $actualCoverage)) {
            return $actualCoverage;
        }

        return new LineCoverageData();
    }

    public function saveReport(): void
    {
        $this->coverage->saveHtmlReport();
    }
}
