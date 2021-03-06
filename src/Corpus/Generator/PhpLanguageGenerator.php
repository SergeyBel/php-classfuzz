<?php

namespace PhpClassFuzz\Corpus\Generator;

use PhpClassFuzz\Collection\Corpus;

class PhpLanguageGenerator implements GeneratorInterface
{
    private DictionaryCorpus $dictionaryCorpus;

    public function __construct(
        ?int $maxLength = null
    ) {
        $this->dictionaryCorpus = new DictionaryCorpus(
            ['abstract', '&', '=', 'array', '(', ')', 'foreach', 'for', '&&', '||', 'bool', 'boolean', '{', '}', 'break', 'callable', 'switch', 'case ', 'match', 'class', 'php', '<?', '?>', '??', '  ', ';', '//', '/*', '*/', '=', '.', '.=', '==', 'const', "'", '"', 'continue', 'break', '$', '++', '--', 'declare', 'default', '__DIR__', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.', 'do', 'while', '=>', 'float', 'real', 'double', 'int', 'string', '::', 'if', 'else', 'elseif', 'final', 'function', 'private', 'protected', 'fn', 'extends', 'implements', 'interface', 'global', 'include', 'require', 'require_once', '<', '>', '!=', '!', '0x', '%=', '*=', 'new', '->', 'return', 'void', 'mixed', '<<', '>>', 'trait', 'yield'],
            $maxLength
        );
    }
    public function generate(int $count): Corpus
    {
        return $this->dictionaryCorpus->generate($count);
    }
}
