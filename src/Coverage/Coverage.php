<?php

namespace PhpClassFuzz\Coverage;

use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;

class Coverage
{
    private $coverage;
    public function __construct()
    {
        $filter = new Filter();
        $filter->includeDirectory('vendor/subberworm/php-css-parser');

        $this->coverage = new CodeCoverage(
            (new Selector)->forLineCoverage($filter),
            $filter
        );

    }
    public function start()
    {


        $this->coverage->start('someid');

    }

    public function stop()
    {
        $this->coverage->stop();

    }

    public function report()
    {
        (new HtmlReport)->process($this->coverage, 'code-coverage-report');

    }

}
