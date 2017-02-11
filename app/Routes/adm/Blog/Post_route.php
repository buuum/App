<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkPost', [\App\Filter\Adm\PostFilter::class, 'checkPost']);

$route->group(['prefix' => 'posts'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Blog\Post\HomeController::class, 'get'])->setName('posts_list');

    $route->get('/add/', [\App\Controller\Adm\Blog\Post\AddController::class, 'get'])->setName('posts_add');
    $route->post('/add/', [\App\Controller\Adm\Blog\Post\AddController::class, 'post']);

    $route->get('/image/add/', [\App\Controller\Adm\Blog\Post\AddController::class, 'add_image'])->setName('posts_add_image');
    $route->get('/tag/add/', [\App\Controller\Adm\Blog\Post\AddController::class, 'add_tag'])->setName('posts_add_tag');

    $route->group(['before' => 'checkPost'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Post\EditController::class, 'get'])->setName('posts_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Post\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Post\DeleteController::class, 'get'])->setName('posts_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Post\DeleteController::class, 'delete']);
    });

});