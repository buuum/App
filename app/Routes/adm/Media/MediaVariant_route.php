<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkMediaVariant', [\App\Filter\Adm\MediaVariantFilter::class, 'checkMediaVariant']);

$route->group(['prefix' => 'mediasvariant'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Media\MediaVariant\HomeController::class, 'get'])->setName('mediasvariant_list');
    $route->get('/add/', [\App\Controller\Adm\Media\MediaVariant\AddController::class, 'get'])->setName('mediasvariant_add');
    $route->post('/add/', [\App\Controller\Adm\Media\MediaVariant\AddController::class, 'post']);

    $route->group(['before' => 'checkMediaVariant'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Media\MediaVariant\EditController::class, 'get'])->setName('mediasvariant_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Media\MediaVariant\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Media\MediaVariant\DeleteController::class, 'get'])->setName('mediasvariant_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Media\MediaVariant\DeleteController::class, 'delete']);
    });

});