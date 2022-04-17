<?php

use PhpClassFuzz\Mutator\Type\String\CopyPartMutator;
use PhpClassFuzz\Random\Random;
use PHPUnit\Framework\TestCase;

class CopyPartMutatorTest extends TestCase
{
    public function stringProvider()
    {
        return [
            'copy start part' => ['abcd', 0, 1, 'ababcd'],
            'copy end part' => ['abcd', 2, 3, 'abcdcd'],
            'copy end part one symbol' => ['abcd', 3, 3, 'abcdd'],
            'copy middle part' => ['abcd', 1, 2, 'abcbcd'],

        ];
    }

    /**
     * @dataProvider stringProvider
     */
    public function testMutate($input, $start, $end, $expected)
    {
        $inputEnd = strlen($input) - 1;

        $randomMock = $this->createMock(Random::class);

        $randomMock
            ->method('getInt')
            ->withConsecutive([0, $inputEnd], [$start, $inputEnd])
            ->willReturnOnConsecutiveCalls($start, $end);

        $this->assertSame($expected, $this->getMutator($randomMock)->mutate($input));
    }

    public function testMutateEmptyString()
    {
        $input = '';

        $randomMock = $this->createMock(Random::class);

        $this->assertSame($input, $this->getMutator($randomMock)->mutate($input));
    }



    private function getMutator($randomMock): CopyPartMutator
    {
        return (new CopyPartMutator())->setRandom($randomMock);
    }
}
