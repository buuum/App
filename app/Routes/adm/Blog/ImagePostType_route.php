<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkImagePostType', [\App\Filter\Adm\ImagePostTypeFilter::class, 'checkImagePostType']);

$route->group(['prefix' => 'imagesposttypes'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Blog\ImagePostType\HomeController::class, 'get'])->setName('imagesposttypes_list');
    $route->get('/add/', [\App\Controller\Adm\Blog\ImagePostType\AddController::class, 'get'])->setName('imagesposttypes_add');
    $route->post('/add/', [\App\Controller\Adm\Blog\ImagePostType\AddController::class, 'post']);

    $route->group(['before' => 'checkImagePostType'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\ImagePostType\EditController::class, 'get'])->setName('imagesposttypes_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\ImagePostType\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\ImagePostType\DeleteController::class, 'get'])->setName('imagesposttypes_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\ImagePostType\DeleteController::class, 'delete']);
    });

});