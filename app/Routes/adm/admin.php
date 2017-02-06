<?php

namespace Routes;

use App\Controller\Adm\Home;
use App\Controller\Adm\User\ForgotController;
use App\Controller\Adm\User\LoginController;
use App\Controller\Adm\User\LogoutController;
use App\Filter\Adm\UserFilter;
use \Buuum\Router;

/** @var Router $route */

$route->filter('enterWithLogin', [UserFilter::class, 'enterWithLogin']);
$route->filter('enterWithoutLogin', [UserFilter::class, 'enterWithoutLogin']);
$route->filter('checkEmailEncode', [UserFilter::class, 'checkEmailEncode']);

$route->group(['prefix' => 'adm'], function (Router $route) {

    $route->group(['before' => 'enterWithLogin'], function (Router $route) {
        $route->get('/', [Home::class, 'get'])->setName('home_adm');
        $route->get('/logout/', [LogoutController::class, 'get'])->setName('logout');

        include_once __DIR__ . '/Rol_route.php';
        include_once __DIR__ . '/Country_route.php';
        include_once __DIR__ . '/User_route.php';

    });

    $route->group(['before' => 'enterWithoutLogin'], function (Router $route) {

        $route->get('/login/', [LoginController::class, 'get'])->setName('login_adm');
        $route->post('/login/', [LoginController::class, 'post']);
        $route->get('/forgot/', [ForgotController::class, 'get'])->setName('user_forgot');
        $route->post('/forgot/', [ForgotController::class, 'post']);

        $route->group(['before' => 'checkEmailEncode'], function (Router $route) {
            $route->get('/forgot/{emailencode:[a-zA-Z0-9-_=]+}/',
                [ForgotController::class, 'getemail'])->setName('user_forgot_pass');
            $route->post('/forgot/{emailencode:[a-zA-Z0-9-_=]+}/', [ForgotController::class, 'postemail']);
        });

    });


});
