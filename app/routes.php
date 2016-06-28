<?php

use Buuum\Router;

return function (Router $route) {


    /*
    |--------------------------------------------------------------------------
    | Routes for scope WEB
    |--------------------------------------------------------------------------
    |
    |
    */
    $route->get('/', ['App\Controller\Web\Home', 'get']);

};