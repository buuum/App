<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkCategory', [\App\Filter\Adm\CategoryFilter::class, 'checkCategory']);

$route->group(['prefix' => 'categories'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Blog\Category\HomeController::class, 'get'])->setName('categories_list');
    $route->get('/add/', [\App\Controller\Adm\Blog\Category\AddController::class, 'get'])->setName('categories_add');
    $route->post('/add/', [\App\Controller\Adm\Blog\Category\AddController::class, 'post']);

    $route->group(['before' => 'checkCategory'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Category\EditController::class, 'get'])->setName('categories_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Category\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Category\DeleteController::class, 'get'])->setName('categories_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Blog\Category\DeleteController::class, 'delete']);
    });

});