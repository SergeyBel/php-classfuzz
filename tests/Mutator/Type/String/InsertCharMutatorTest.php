<?php

use PhpClassFuzz\Mutator\Type\String\InsertCharMutator;
use PhpClassFuzz\Random\Random;
use PHPUnit\Framework\TestCase;

class InsertCharMutatorTest extends TestCase
{
    public function stringProvider()
    {
        return [
            'insert in string start' => ['bcd', 0, 'abcd'],
            'insert in string end' => ['bcd', 3, 'bcda'],
            'insert in string middle' => ['bcd', 2, 'bcad'],
        ];
    }

    /**
     * @dataProvider stringProvider
     */
    public function testMutate($input, $position, $expected)
    {
        $inputEnd = strlen($input);

        $randomMock = $this->createMock(Random::class);
        $randomMock
            ->method('getChar')
            ->with()
            ->willReturn('a');

        $randomMock
            ->method('getInt')
            ->with(0, $inputEnd)
            ->willReturn($position);

        $this->assertSame($expected, $this->getMutator($randomMock)->mutate($input));
    }

    public function testMutateEmptyString()
    {
        $input = '';

        $randomMock = $this->createMock(Random::class);
        $randomMock
            ->method('getChar')
            ->with()
            ->willReturn('a');



        $this->assertSame('a', $this->getMutator($randomMock)->mutate($input));
    }



    private function getMutator($randomMock): InsertCharMutator
    {
        return new InsertCharMutator($randomMock);
    }
}
