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

    }

}