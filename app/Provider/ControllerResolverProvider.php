<?php

namespace App\Provider;

use App\Support\ControllerResolver;
use Buuum\Exception\HttpMethodNotAllowedException;
use Buuum\Exception\HttpRouteNotFoundException;
use League\Container\Container;

class ControllerResolverProvider
{
    public function register(Container $app)
    {
        $app->share('controller_resolver', function () use ($app) {
            return new ControllerResolver($app);
        });
    }

}
