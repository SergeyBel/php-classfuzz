<?php

namespace PhpClassFuzz\File;

use PhpClassFuzz\Fuzz\BaseFuzz;
use PhpClassFuzz\Fuzz\FuzzInterface;

class FuzzClassFinder
{
    /**
     * @param string[] $files
     * @return FuzzInterface[]
     */
    public function findFuzzClasses(array $files): array
    {
        foreach ($files as $file) {
            include_once $file;
        }

        $declaredClasses = get_declared_classes();
        $fuzzClasses = [];
        foreach ($declaredClasses as $class) {
            if ($class == BaseFuzz::class) {
                continue;
            }
            if (in_array(FuzzInterface::class, class_implements($class))) {
                $fuzzClasses[] = new $class();
            }
        }


        return $fuzzClasses;
    }
}
