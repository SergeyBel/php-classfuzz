<?php

namespace PhpClassFuzz\Coverage;

class LineCoverageAnalyzer
{
    public function hasNewLines(LineCoverageData $oldData, LineCoverageData $newData)
    {
        $oldFiles = $oldData->getFiles();
        $newFiles = $newData->getFiles();

        if (count(array_diff($newFiles, $oldFiles)) > 0) {
            return true;
        }

        foreach ($newFiles as $file) {
            $newLines = $newData->getLines($file);
            $oldLines = $oldData->getLines($file);
            if (count(array_diff($newLines, $oldLines)) > 0) {
                return true;
            }
        }

        return false;
    }
}
