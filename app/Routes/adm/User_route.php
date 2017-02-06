<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkUser', [\App\Filter\Adm\UserFilter::class, 'checkUser']);

$route->group(['prefix' => 'users'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\User\HomeController::class, 'get'])->setName('users_list');
    $route->get('/add/', [\App\Controller\Adm\User\AddController::class, 'get'])->setName('users_add');
    $route->post('/add/', [\App\Controller\Adm\User\AddController::class, 'post']);

    $route->group(['before' => 'checkUser'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\User\EditController::class, 'get'])->setName('users_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\User\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\User\DeleteController::class, 'get'])->setName('users_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\User\DeleteController::class, 'delete']);
    });

});