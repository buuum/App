<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkImagePost', [\App\Filter\Adm\ImagePostFilter::class, 'checkImagePost']);

$route->group(['prefix' => 'imagespost'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Blog\ImagePost\HomeController::class, 'get'])->setName('imagespost_list');
    $route->get('/add/', [\App\Controller\Adm\Blog\ImagePost\AddController::class, 'get'])->setName('imagespost_add');
    $route->post('/add/', [\App\Controller\Adm\Blog\ImagePost\AddController::class, 'post']);

    $route->post('/upload/', [\App\Controller\Adm\Blog\ImagePost\AddController::class, 'upload_image'])->setName('posts_upload_image');


    $route->group(['before' => 'checkImagePost'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\ImagePost\EditController::class, 'get'])->setName('imagespost_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\ImagePost\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\ImagePost\DeleteController::class, 'get'])->setName('imagespost_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\ImagePost\DeleteController::class, 'delete']);
    });

});