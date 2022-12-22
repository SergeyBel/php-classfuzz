<?php
namespace PhpClassFuzz\Fuzzer\Coverage;

use PhpClassFuzz\Coverage\LineCoverageData;

class CoverageEmptyExplorer implements CoverageExplorerInterface
{
    public function start(string $coveragePath): void
    {
        return;
    }

    public function explore(LineCoverageData $oldCoverage): LineCoverageData
    {
        return new LineCoverageData();
    }

    public function saveReport(): void
    {
        return;
    }


}
