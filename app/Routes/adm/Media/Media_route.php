<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkMedia', [\App\Filter\Adm\MediaFilter::class, 'checkMedia']);

$route->group(['prefix' => 'medias'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Media\Media\HomeController::class, 'get'])->setName('medias_list');
    $route->get('/add/', [\App\Controller\Adm\Media\Media\AddController::class, 'get'])->setName('medias_add');
    $route->post('/add/', [\App\Controller\Adm\Media\Media\AddController::class, 'post']);

    $route->group(['before' => 'checkMedia'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Media\Media\EditController::class, 'get'])->setName('medias_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Media\Media\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Media\Media\DeleteController::class, 'get'])->setName('medias_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Media\Media\DeleteController::class, 'delete']);
    });

});