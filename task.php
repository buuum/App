#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/app/app.php';

use Symfony\Component\Console\Application;

$console = new Application();

array_map([$console, 'add'], $app->get('commands'));

$console->run();