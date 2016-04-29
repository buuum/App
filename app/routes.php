<?php

use Buuum\Router;

return function (Router $route) {

    $route->get('/', array('Application\Controller\Web\HomeController', 'getIndex'))->setName('index');
};