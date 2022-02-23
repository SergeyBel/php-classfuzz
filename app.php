#!/usr/bin/env php
<?php
// app.php

use PhpClassFuzz\Application\Application;

require __DIR__.'/autoload.php';

$app = new Application();
$app->registerCommands();
$app->run();
