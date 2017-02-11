<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkMediaType', [\App\Filter\Adm\MediaTypeFilter::class, 'checkMediaType']);

$route->group(['prefix' => 'mediastype'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Media\MediaType\HomeController::class, 'get'])->setName('mediastype_list');
    $route->get('/add/', [\App\Controller\Adm\Media\MediaType\AddController::class, 'get'])->setName('mediastype_add');
    $route->post('/add/', [\App\Controller\Adm\Media\MediaType\AddController::class, 'post']);

    $route->group(['before' => 'checkMediaType'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Media\MediaType\EditController::class, 'get'])->setName('mediastype_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Media\MediaType\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Media\MediaType\DeleteController::class, 'get'])->setName('mediastype_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Media\MediaType\DeleteController::class, 'delete']);
    });

});