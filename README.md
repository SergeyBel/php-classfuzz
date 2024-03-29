# PHP class fuzzer
This is a feedback-based fuzzer for PHP classes



# Installation
`composer require --dev sergey-bel/php-classfuzz`


# Overview
Fuzzer generates a lot of inputs and runs the needed code with these inputs. Fuzzer analyzes executions results and reports if something went wrong (f.e. unexpected exception or php error are thrown)  
First fuzzer generates corpus - set of initial data  
Then it applyes some mutators to data from corpus to get different inputs for fuzzing



# Usage
To get started fuzzing a class you need to create Fuzz-class:

* class must be called `...Fuzz`
* class must extend `BaseFuzz` abstract class
* `fuzz` method must be implemented in the class
* `getInputs()` method must be implemented in the class

Example (class file in 'fuzzing' directory):
```php
<?php


use PhpClassFuzz\Argument\Argument;
use PhpClassFuzz\Argument\Input;
use PhpClassFuzz\Fuzz\BaseFuzz;
use Symfony\Component\Yaml\Yaml;

class YamlFuzz extends BaseFuzz
{
    public function getInputs(): array
    {
        return [
           new Input(
               [new Argument(
                   [
                   'key1' => [
                       'key2' => 'value'
                   ]
               ]
               )
           ]
           ),
       ];
    }

    public function getMaxCount(): ?int
    {
        return 250;
    }

    public function getCoveragePath(): ?string
    {
        return __DIR__. '/../../vendor/symfony/yaml';
    }

    public function metPostCondition(Input $input, mixed $callResult): bool
    {
        return $callResult == $input->arguments[0]->value;
    }


    public function fuzz(Input $input)
    {
        $value = Yaml::parse(Yaml::dump($input->arguments[0]->value));
        return $value;
    }
}

```

then run command `vendor/bin/php-classfuzz fuzzing --dir=<dirWithFuzzFiles> --debug`

# Main concepts

## Development
1. git clone https://github.com/SergeyBel/php-classfuzz.git
2. docker-compose build
3. docker-compose up -d
4. use make commands


`make test` - run tests  
`make fix` - run code style fixer  
`make static` - run code static analysis 


