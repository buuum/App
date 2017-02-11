<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkTag', [\App\Filter\Adm\TagFilter::class, 'checkTag']);

$route->group(['prefix' => 'tags'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Blog\Tag\HomeController::class, 'get'])->setName('tags_list');
    $route->get('/add/', [\App\Controller\Adm\Blog\Tag\AddController::class, 'get'])->setName('tags_add');
    $route->post('/add/', [\App\Controller\Adm\Blog\Tag\AddController::class, 'post']);

    $route->group(['before' => 'checkTag'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Tag\EditController::class, 'get'])->setName('tags_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Tag\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Tag\DeleteController::class, 'get'])->setName('tags_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Tag\DeleteController::class, 'delete']);
    });

});