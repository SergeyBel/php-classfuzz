<?php

namespace PhpClassFuzz\Fuzz\Result;

use PhpClassFuzz\Fuzz\FuzzInterface;
use Throwable;

class FuzzingExceptionResult implements FuzzingResultInterface
{
    private string $fuzzClassName;

    private string $exceptionClass;

    private string $message;

    private mixed $input;


    public function __construct(FuzzInterface $fuzzClass, Throwable $e, mixed $input)
    {
        $this->fuzzClassName = get_class($fuzzClass);
        $this->exceptionClass = get_class($e);
        $this->message = $e->getMessage();
        $this->input = $input;
    }


    public function getExceptionClass(): string
    {
        return $this->exceptionClass;
    }


    public function getMessage(): string
    {
        return $this->message;
    }


    public function getInput(): mixed
    {
        return $this->input;
    }

    public function getFuzzClassName(): string
    {
        return $this->fuzzClassName;
    }
}
