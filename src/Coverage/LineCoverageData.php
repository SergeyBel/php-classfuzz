<?php

namespace PhpClassFuzz\Coverage;

class LineCoverageData
{
    private array $data = [];

    public function addLine(string $file, int $lineNumber)
    {
        if (!array_key_exists($file, $this->data)) {
            $this->data[$file] = [];
        }

        if (!in_array($lineNumber, $this->data[$file])) {
            array_push($this->data[$file], $lineNumber);
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getFiles()
    {
        return array_keys($this->data);
    }

    public function getLines(string $file): ?array
    {
        return isset($this->data[$file]) ? $this->data[$file] : null;
    }

    public function merge(LineCoverageData $coverageData)
    {
        $this->data = array_merge_recursive($this->data, $coverageData->getData());
    }

    public function totalLines(): int
    {
        $total = 0;
        foreach ($this->data as $file => $lines) {
            $total += count($lines);
        }
        return $total;
    }
}
