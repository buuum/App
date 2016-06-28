<?php

namespace App\Provider;

use League\Container\Container;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionProvider
{

    public function register(Container $app)
    {
        $app->share('Symfony\Component\HttpFoundation\Session\Session', function () use ($app) {
            $config = $app->get('config');
            $session = new Session();
            $session->setName($config->get('session.name') . '_' . $config->get('scope'));
            return $session;
        });
    }

}