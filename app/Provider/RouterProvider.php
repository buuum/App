<?php

namespace App\Provider;

use Buuum\Dispatcher;
use Buuum\Router;
use League\Container\Container;

class RouterProvider
{
    public function register(Container $app)
    {
        $app->share('router', function () use ($app) {

            //$time = microtime(true);
            $router = new Router();
            $paths = $app->get('paths');
            $collector = $this->getRouteCollectorCallback($paths['routes']);
            $collector($router);

            $routeData = $router->getData();
            //file_put_contents(__DIR__.'/routes', json_encode($routeData));
            //dd(json_encode($routeData));

            //$routeData = file_get_contents(__DIR__ . '/routes');
            //$routeData = json_decode($routeData, true);
            $dispatcher = new Dispatcher($routeData);

            //dd(microtime(true) - $time);
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
