<?php
namespace PhpClassFuzz\Tests\Corpus;

use PhpClassFuzz\Collection\Corpus;
use PHPUnit\Framework\TestCase;

class CorpusTest extends TestCase
{
    public function testExistsGetNextCorpusItem()
    {
        $corpus = new Corpus([1234]);
        $this->assertSame(1234, $corpus->getNextCorpusItem());
    }

}
