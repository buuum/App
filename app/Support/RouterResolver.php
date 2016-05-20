<?php namespace Application\Support;

use Buuum\HandlerResolverInterface;
use League\Container\Container;

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
            $this->container->share($handler[0])
                ->withMethodCall('setView', ['view'])
                ->withMethodCall('setHeader', ['header'])
                ->withMethodCall('setRequest', ['request'])
                ->withMethodCall('setSession', ['session'])
                ->withMethodCall('setRouter', ['router'])
                ->withMethodCall('iniController');

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
        $scope = $this->getScope($request);
        $error_controller = "Application\\Controller\\$scope\\ErrorController";
        $this->container->share($error_controller)
            ->withMethodCall('setView', ['view'])
            ->withMethodCall('setHeader', ['header'])
            ->withMethodCall('setRequest', ['request'])
            ->withMethodCall('setSession', ['session'])
            ->withMethodCall('setRouter', ['router'])
            ->withMethodCall('iniController');

        if ($type_error == 404) {
            // ROUTE NOT FOUND
            return $this->container->get($error_controller)->error404();
        } elseif ($type_error == 405) {
            // REQUEST METHOD NOT ALLOWED
            return $this->container->get($error_controller)->error405();
        } elseif ($type_error == 406) {
            // CLASS METHOD DOESNT EXIST
            return $this->container->get($error_controller)->error404();
        } else {
            // UNKNOW ERROR
            return $this->container->get($error_controller)->error500();
        }

    }

    protected function getScope($request)
    {

        $config = $this->container->get('config');
        $scopes = $config->get('scopes');

        if (!empty($scopes)) {

            foreach ($scopes as $scope => $prefix) {
                if ($prefix && substr($request['path'], 0, strlen($prefix)) == $prefix) {
                    $config->set('scope', $scope);
                    return $scope;
                }
            }
        }

        return $this->container->get('config')->get('scope');
    }
}