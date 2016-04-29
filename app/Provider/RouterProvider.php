<?php

namespace Application\Provider;

use Buuum\Dispatcher;
use Buuum\Router;
use League\Container\Container;

class RouterProvider
{
    public function register(Container $app)
    {
        $app->share('router', function () use ($app) {

            $router = new Router();
            $paths = $app->get('paths');
            $collector = $this->getRouteCollectorCallback($paths['routes']);
            $collector($router);

            $routeData = $router->getData();

            $dispatcher = new Dispatcher($routeData);

            $app->share('urls', function () use ($dispatcher) {
                return $dispatcher;
            });

            return $dispatcher;

        });
    }

    /**
     * @param string $file
     * @return \Closure
     */
    private function getRouteCollectorCallback($file)
    {
        return include $file;
    }

}