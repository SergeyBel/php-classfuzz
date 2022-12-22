<?php
namespace PhpClassFuzz\Fuzzer\Coverage;

use PhpClassFuzz\Coverage\LineCoverageData;

interface CoverageExplorerInterface
{
    public function start(string $coveragePath): void;

    public function explore(LineCoverageData $oldCoverage): LineCoverageData;

    public function saveReport(): void;
}
