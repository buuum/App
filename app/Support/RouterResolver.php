<?php

namespace App\Support;

use Buuum\HandlerResolverInterface;
use League\Container\Container;
use Symfony\Component\HttpFoundation\Response;

class RouterResolver implements HandlerResolverInterface
{
    private $parse_errors;
    private $container;

    public function __construct(Container $container, $parse_errors = true)
    {
        $this->container = $container;
        $this->parse_errors = $parse_errors;
    }

    public function resolve($handler)
    {
        if (is_array($handler) and is_string($handler[0])) {

            $this->container->share($handler[0])->withArguments([$this->container]);

            $handler[0] = $this->container->get($handler[0]);

        }

        return $handler;
    }

    public function parseErrors()
    {
        return $this->parse_errors;
    }

    public function resolveErrors($type_error, $request)
    {
        $config = $this->container->get('config');
        $scope = $config->get('scope');

        $error_controller = "App\\Controller\\$scope\\ErrorController";

        $this->container->share($error_controller)->withArguments([$this->container]);

        if ($type_error == 404) {
            // ROUTE NOT FOUND
            //return $this->container->get($error_controller)->error404();
            return new Response($this->container->get($error_controller)->error404(), 404);
        } elseif ($type_error == 405) {
            // REQUEST METHOD NOT ALLOWED
            //return $this->container->get($error_controller)->error405();
            return new Response($this->container->get($error_controller)->error405(), 405);
        } elseif ($type_error == 406) {
            // CLASS METHOD DOESNT EXIST
            //return $this->container->get($error_controller)->error404();
            return new Response($this->container->get($error_controller)->error404(), 404);
        } else {
            // UNKNOW ERROR
            //return $this->container->get($error_controller)->error500();
            return new Response($this->container->get($error_controller)->error500(), 500);
        }

    }

    private function getContructArguments($classname)
    {
        $arguments = [];
        $reflector = new \ReflectionClass($classname);

        if ($reflector->getConstructor()) {
            foreach ($reflector->getConstructor()->getParameters() as $param) {
                $classname = $param->getClass()->name;
                if ($classname == 'Buuum\Config') {
                    $classname = 'config';
                }
                $arguments[] = $classname;
            }
        }

        return $arguments;
    }
}
