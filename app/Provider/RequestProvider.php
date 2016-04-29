<?php

namespace Application\Provider;

use League\Container\Container;
use Symfony\Component\HttpFoundation\Request;

class RequestProvider
{
    public function register(Container $app)
    {
        $app->share('request', function () {
            return Request::createFromGlobals();
        });

        $config = $app->get('config');
        $scopes = $config->get('scopes');
        if (!empty($scopes)) {
            $urlpath = $app->get('request')->getPathInfo();

            foreach ($scopes as $scope => $prefix) {
                if ($prefix && substr($urlpath, 0, strlen($prefix)) == $prefix) {
                    $config->set('scope', $scope);
                }
            }
        }
    }

}