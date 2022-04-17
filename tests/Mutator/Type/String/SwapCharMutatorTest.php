<?php

use PhpClassFuzz\Mutator\Type\String\SwapCharMutator;
use PhpClassFuzz\Random\Random;
use PHPUnit\Framework\TestCase;

class SwapCharMutatorTest extends TestCase
{
    public function stringProvider()
    {
        return [
            'swap in string start' => ['abcd', 0, 1, 'bacd'],
            'swap in string end' => ['abcd', 2, 3, 'abdc'],
            'swap in string middle' => ['abcd', 1, 2, 'acbd'],
            'swap start less end' => ['abcd', 2, 1, 'acbd'],
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
            ->withConsecutive([0, $inputEnd], [0, $inputEnd])
            ->willReturnOnConsecutiveCalls($start, $end);

        $this->assertSame($expected, $this->getMutator($randomMock)->mutate($input));
    }

    public function testMutateEmptyString()
    {
        $input = '';

        $randomMock = $this->createMock(Random::class);

        $this->assertSame($input, $this->getMutator($randomMock)->mutate($input));
    }



    private function getMutator($randomMock): SwapCharMutator
    {
        return (new SwapCharMutator())->setRandom($randomMock);
    }
}
