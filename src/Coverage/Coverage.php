<?php

namespace PhpClassFuzz\Coverage;

use Exception;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\ProcessedCodeCoverageData;

class Coverage
{
    private CodeCoverage $coverage;
    private Filter $filter;
    private ?string $path;


    public function __construct()
    {
        $this->path = null;
        $this->filter = new Filter();
    }
    public function start(string $path): void
    {
        if (!$this->path) {
            $realpath = realpath($path);
            if (!$realpath) {
                throw new Exception('coverage path not found');
            }
            $this->path = $path;
            $this->filter->includeDirectory($path);
            $this->coverage = new CodeCoverage(
                (new Selector())->forLineAndPathCoverage($this->filter),
                $this->filter
            );
        }


        $this->coverage->start($this->path);
    }

    public function stop(): void
    {
        $this->coverage->stop();
    }

    public function getCoverageData(): LineCoverageData
    {
        return $this->parseCoverageData($this->coverage->getData());
    }

    private function parseCoverageData(ProcessedCodeCoverageData $coverageData): LineCoverageData
    {
        $data = new LineCoverageData();
        $linesData = $coverageData->lineCoverage();
        foreach ($linesData as $file => $lines) {
            foreach ($lines as $lineNumber => $lineInfo) {
                if (!empty($lineInfo)) {
                    $data->addLine($file, $lineNumber);
                }
            }
        }

        return $data;
    }
}
