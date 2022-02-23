<?php

namespace PhpClassFuzz\Command;

use PhpClassFuzz\Runner\Runner;
use PhpClassFuzz\Runner\RunnerConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FuzzCommand extends Command
{
    public function __construct(
        private Runner $runner
    ) {
        parent::__construct();
    }

    protected static $defaultName = 'fuzzing';


    protected function configure(): void
    {
        $this->addOption('dir', null, InputOption::VALUE_REQUIRED);
        $this->addOption('debug', null, InputOption::VALUE_NONE);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $config = (new RunnerConfiguration())
            ->setDirectory($input->getOption('dir'))
            ->setDebug($input->getOption('debug'));
        $this->runner->runAllFuzz($config);
        return Command::SUCCESS;
    }
}
