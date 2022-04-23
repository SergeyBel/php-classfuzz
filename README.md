# PHP class fuzzer
This is a fuzzer for PHP classes. It can be used to find bugs by [fuzzing](https://en.wikipedia.org/wiki/Fuzzing) it



# Installation
`composer require sergey-bel/php-classfuzz`


# Overview
Fuzzer generates a lot of inputs and runs the needed code with these inputs. Fuzzer analyzes executions results and reports if something went wrong (f.e. unexpected exception or php error are thrown)  
First fuzzer generates corpus - set of initial data  
Then it applyes some mutators to data from corpus to get different inputs for fuzzing



# Usage
To get started fuzzing a class you need to create Fuzz-class:

* class must be called `...Fuzz`
* class must extend `BaseFuzz` abstract class
* `fuzz` method must be implemented in the class
* `getArguments()` method must be implemented in the class


Example (class file in 'fuzzing' directory):
```php
class SimpleFuzz extends BaseFuzz
{
    // describe how to generate arguments for fuzz() method
    // set initial Corpus and Mutators
    public function getArgument(): Argument
    {
        $argument = new Argument(
            (new CharStringCorpus())->generate(100),
            StringMutatorFacade::getAllMutators(),
        );

        return $argument;
    }

    // set expectations about exceptions
    // to ignore some exceptions return true
    // in this example all exceptions threaded as fuzz error
    public function ignoreThrowable(\Throwable $throwable): bool
    {
        return false;
    }

    // set maximum count of `fuzz` method call
    public function getMaxCount(): int
    {
        return 1000;
    }
    
    // check post conditions for method result
    // can be used for various checks of method output
    // in this example no checks
    public function metPostCondition(mixed $callResult): bool
    {
        return true;
    }

    // main method in fuzzing process
    // this method will be called with different inputs
    // arguments will be generated by settings from `getArguments` method
    // you can write here any logic for fuzzing
    public function fuzz(string $text)
    {
        if (strlen($text) > 50) {
            throw new Exception();
        }
    }
}
```

then run command `vendor/bin/php-classfuzz fuzzing --dir=fuzzing`

# Main concepts

## Corpus
Corpus is a set of initial data for fuzzing. This data will then be mutated to get fuzzing inputs. To simplify the creation of Corpus for common cases some special generators are implemented  
Generator classes must implement `GeneratorInterface`


## Mutators
Data from corpus are mutated by Mutators classes  
Mutator classes must implement `MutatorInterface`


## PostConditions
Post conditions are used to check the result of a `fuzz` method call. If some conditions need to be met for the results of the `fuzz` method they can be checked in `metPostCondition` method  

## Coverage
This library has the option to apply coverage analysis to find the most perspective input data. To activate coverage analysis, it is needed to use method `getCoveragePath`


## Development
1. git clone https://github.com/SergeyBel/php-classfuzz.git
2. docker-compose build
3. docker-compose up -d
4. use make commands


`make test` - run tests  
`make fix` - run code style fixer  
`make static` - run code static analysis 


