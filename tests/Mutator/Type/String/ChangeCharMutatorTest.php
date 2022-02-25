<?php

use PhpClassFuzz\Mutator\Type\String\ChangeCharMutator;
use PhpClassFuzz\Random\Random;
use PHPUnit\Framework\TestCase;

class ChangeCharMutatorTest extends TestCase
{
    public function stringProvider()
    {
        return [
            'change string start' => ['bcd', 0, 'acd'],
            'change string end' => ['bcd', 2, 'bca'],
            'change string middle' => ['bcd', 1, 'bad'],
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

        $this->assertSame($input, $this->getMutator($randomMock)->mutate($input));
    }



    private function getMutator($randomMock): ChangeCharMutator
    {
        return new ChangeCharMutator($randomMock);
    }
}
