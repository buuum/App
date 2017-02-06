<?php

use \Buuum\Router;

/** @var Router $route */

$route->filter('checkCountry', [\App\Filter\Adm\CountryFilter::class, 'checkCountry']);

$route->group(['prefix' => 'countries'], function (Router $route) {

    $route->get('/', [\App\Controller\Adm\Country\HomeController::class, 'get'])->setName('countries_list');
    $route->get('/add/', [\App\Controller\Adm\Country\AddController::class, 'get'])->setName('countries_add');
    $route->post('/add/', [\App\Controller\Adm\Country\AddController::class, 'post']);

    $route->group(['before' => 'checkCountry'], function(Router $route){
        $route->get('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Country\EditController::class, 'get'])->setName('countries_edit');
        $route->post('/edit/{id:[0-9]+}/', [\App\Controller\Adm\Country\EditController::class, 'post']);

        $route->get('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Country\DeleteController::class, 'get'])->setName('countries_delete');
        $route->delete('/delete/{id:[0-9]+}/', [\App\Controller\Adm\Country\DeleteController::class, 'delete']);
    });

});