<?php

namespace PhpClassFuzz\Coverage;

class LineCoverageData
{
    /** @var array<string, array<int>>  */
    private array $data = [];

    public function addLine(string $file, int $lineNumber): void
    {
        if (!array_key_exists($file, $this->data)) {
            $this->data[$file] = [];
        }

        if (!in_array($lineNumber, $this->data[$file])) {
            array_push($this->data[$file], $lineNumber);
        }
    }

    /**
     * @return array<string, array<int>>
     */
    public function getData(): array
    {
        return $this->data;
    }


    /**
     * @return string[]
     */
    public function getFiles(): array
    {
        return array_keys($this->data);
    }

    /**
     * @return int[]
     */
    public function getLines(string $file): ?array
    {
        return isset($this->data[$file]) ? $this->data[$file] : [];
    }

    public function merge(LineCoverageData $coverageData): void
    {
        $this->data = array_merge_recursive($this->data, $coverageData->getData());
    }

    public function totalLines(): int
    {
        $total = 0;
        foreach ($this->data as $lines) {
            $total += count($lines);
        }
        return $total;
    }
}
