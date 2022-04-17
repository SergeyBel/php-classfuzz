<?php

use PhpClassFuzz\Mutator\Type\String\DeleteCharMutator;
use PhpClassFuzz\Random\Random;
use PHPUnit\Framework\TestCase;

class DeleteCharMutatorTest extends TestCase
{
    public function stringProvider()
    {
        return [
            'delete in string start' => ['abc', 0, 'bc'],
            'delete in string end' => ['abc', 2, 'ab'],
            'delete in string middle' => ['abc', 1, 'ac'],
        ];
    }

    /**
     * @dataProvider stringProvider
     */
    public function testMutate($input, $position, $expected)
    {
        $inputEnd = strlen($input) - 1;

        $randomMock = $this->createMock(Random::class);

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

        $this->assertSame($input, $this->getMutator($randomMock)->mutate($input));
    }



    private function getMutator($randomMock): DeleteCharMutator
    {
        return (new DeleteCharMutator())->setRandom($randomMock);
    }
}
