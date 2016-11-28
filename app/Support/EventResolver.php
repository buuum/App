<?php

namespace App\Support;

use Buuum\EventResolverInterface;
use League\Container\Container;

class EventResolver implements EventResolverInterface
{
    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function resolve($handler)
    {
        if (is_array($handler) and is_string($handler[0])) {
            $this->container->share($handler[0])->withArguments([$this->container]);
            $handler[0] = $this->container->get($handler[0]);
        }
        return $handler;
    }
}