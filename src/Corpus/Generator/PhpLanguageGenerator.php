<?php

namespace PhpClassFuzz\Corpus\Generator;

use PhpClassFuzz\Collection\Corpus;

class PhpLanguageGenerator implements GeneratorInterface
{
    private ?int $maxLength = null;

    public function __construct(
        private DictionaryCorpus $dictionaryCorpus
    ) {
    }
    public function generate(int $count): Corpus
    {
        $phpTokens = ['abstract', '&', '=', 'array', '(', ')', 'foreach', 'for', '&&', '||', 'bool', 'boolean', '{', '}', 'break', 'callable', 'switch', 'case ', 'match', 'class', 'php', '<?', '?>', '??', '  ', ';', '//', '/*', '*/', '=', '.', '.=', '==', 'const', "'", '"', 'continue', 'break', '$', '++', '--', 'declare', 'default', '__DIR__', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.', 'do', 'while', '=>', 'float', 'real', 'double', 'int', 'string', '::', 'if', 'else', 'elseif', 'final', 'function', 'private', 'protected', 'fn', 'extends', 'implements', 'interface', 'global', 'include', 'require', 'require_once', '<', '>', '!=', '!', '0x', '%=', '*=', 'new', '->', 'return', 'void', 'mixed', '<<', '>>', 'trait', 'yield'];

        $this->dictionaryCorpus->setDictionary($phpTokens);
        if ($this->maxLength) {
            $this->dictionaryCorpus->setMaxLen($this->maxLength);
        }

        return $this->dictionaryCorpus->generate($count);
    }


    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }


    public function setMaxLength(?int $maxLength): self
    {
        $this->maxLength = $maxLength;
        return $this;
    }
}
