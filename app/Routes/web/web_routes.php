<?php

use Buuum\Router;

/** @var Router $route */

$route->get('/', [\App\Controller\Web\Home::class, 'get'])->setName('home');
