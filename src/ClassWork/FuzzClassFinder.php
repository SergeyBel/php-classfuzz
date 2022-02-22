<?php

namespace PhpClassFuzz\ClassWork;

use PhpClassFuzz\Fuzz\FuzzInterface;

class FuzzClassFinder
{
    public function findFuzzClasses(array $files): array
    {
        foreach ($files as $file) {
            include_once $file;
        }

        $declaredClasses = get_declared_classes();
        $fuzzClasses = [];
        foreach ($declaredClasses as $class) {
            if (in_array(FuzzInterface::class, class_implements($class))) {
                $fuzzClasses[] = $class;
            }
        }

        return $fuzzClasses;
    }
}
