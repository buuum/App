<?php namespace Application\Support;

use Buuum\HandlerResolverInterface;
use League\Container\Container;

class RouterResolver implements HandlerResolverInterface
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function resolve($handler)
    {
        if (is_array($handler) and is_string($handler[0])) {
            $this->container->share($handler[0])
                ->withMethodCall('setView', ['view'])
                ->withMethodCall('setHeader', ['header'])
                ->withMethodCall('setRequest', ['request'])
                ->withMethodCall('setSession', ['session'])
                ->withMethodCall('iniController');

            $handler[0] = $this->container->get($handler[0]);
        }

        return $handler;
    }
}