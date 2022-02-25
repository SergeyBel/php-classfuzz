<?php

namespace PhpClassFuzz\Context;

class Context
{
    private static $input;

    private static string $fuzzClassName;


    public static function getInput()
    {
        return self::$input;
    }


    public static function setInput($input)
    {
        self::$input = $input;
    }

    public static function getFuzzClassName(): string
    {
        return self::$fuzzClassName;
    }


    public static function setFuzzClassName(string $fuzzClassName)
    {
        self::$fuzzClassName = $fuzzClassName;
    }
}
