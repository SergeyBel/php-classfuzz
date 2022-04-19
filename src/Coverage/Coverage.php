<?php

namespace PhpClassFuzz\Coverage;

use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use Exception;

class Coverage
{
    private $coverage;
    private $filter;
    private $path;
    public function __construct()
    {
        $this->path = null;
        $this->filter = new Filter();
    }
    public function start($path)
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

    public function stop()
    {
        $this->coverage->stop();
    }

    public function getCoverageData()
    {
        return $this->parseCoverageData($this->coverage->getData());
    }

    private function parseCoverageData($coverageData): LineCoverageData
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
