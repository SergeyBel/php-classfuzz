<?php

namespace PhpClassFuzz\File;

use Symfony\Component\Finder\Finder;

class FuzzFileFinder
{
    public function findFuzzFiles(string $directory): array
    {
        $finder = new Finder();
        $files = $finder->files()->in($directory)->name('*Fuzz.php');
        $fuzzFiles = [];
        foreach ($files as $file) {
            $fuzzFiles[] = $file->getRealPath();
        }
        return $fuzzFiles;
    }
}
