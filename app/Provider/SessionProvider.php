<?php

namespace Application\Provider;

use League\Container\Container;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionProvider
{

    public function register(Container $app)
    {
        $app->share('session', function () use ($app) {
            $config = $app->get('config');
            $session = new Session();
            $session->setName($config->get('session.name'));
            return $session;
        });
    }

}