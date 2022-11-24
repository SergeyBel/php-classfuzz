<?php

namespace PhpClassFuzz\Mutator;

use PhpClassFuzz\Argument\Input;
use PhpClassFuzz\Random\Random;

class InputMutator
{
    public const MAX_MUTANTS = 100;
    public function __construct(
        private Random $random,
        private ArgumentMutator $argumentMutator
    ) {
    }

    /**
     * @return Input[]
     */
    public function mutateInput(Input $input): array
    {
        $mutantsCount = $this->random->getInt(1, self::MAX_MUTANTS);
        $mutants = [];
        $arguments = $input->arguments;
        for ($i = 0; $i < $mutantsCount; $i++) {
            $mutant = [];
            foreach ($arguments as $argument) {
                $mutant[] = $this->argumentMutator->mutateArgument($argument);
            }
            $mutants[] = new Input($mutant);
        }
        return $mutants;
    }
}
