<?php

namespace App\Support;

use League\Container\Container;

class ControllerResolver
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getController($class, $method)
    {

      if(!class_exists($class)){
        throw new \InvalidArgumentException(sprintf('Controller "%s" does not exist.', $class));
      }

       if(!method_exists($class, $method)){
          throw new \InvalidArgumentException(sprintf('Controller "%s" doesnt have the method %s.', $class, $method));
       }

       $callable = $this->createController($class, $method);
       if (!is_callable($callable)) {
           throw new \InvalidArgumentException(sprintf('The controller "%s" with the method %s is not callable.', $class, $method));
       }

       return $callable;
    }

    protected function createController($class, $method)
    {
        return [$this->instantiateController($class), $method];
    }

    public function instantiateController($class)
    {
        return new $class($this->container);
    }
}