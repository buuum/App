<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkRol', [\App\Filter\Adm\RolFilter::class, 'checkRol']);

$route->group(['prefix' => 'roles'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Rol\HomeController::class, 'get'])->setName('roles_list');
    $route->get('/add/', [\App\Controller\Adm\Rol\AddController::class, 'get'])->setName('roles_add');
    $route->post('/add/', [\App\Controller\Adm\Rol\AddController::class, 'post']);

    $route->group(['before' => 'checkRol'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Rol\EditController::class, 'get'])->setName('roles_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Rol\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Rol\DeleteController::class, 'get'])->setName('roles_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Rol\DeleteController::class, 'delete']);
    });

});