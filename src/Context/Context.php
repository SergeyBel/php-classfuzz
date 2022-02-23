<?php

namespace PhpClassFuzz\Context;

class Context
{
    private static array $args;
    private static string $fuzzClassName;


    public static function getArgs(): array
    {
        return self::$args;
    }


    public static function setArgs(array $args)
    {
        self::$args = $args;
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
