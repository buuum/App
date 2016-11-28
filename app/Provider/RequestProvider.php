<?php

namespace App\Provider;

use League\Container\Container;
use Symfony\Component\HttpFoundation\Request;

class RequestProvider
{
    public function register(Container $app)
    {
        $app->share('current_request', function () {
            //$_POST => $request->request->all();
            //$_GET => $request->query->all()
            //$_FILES => $request->files->all()
            return Request::createFromGlobals();
        });
    }
}
