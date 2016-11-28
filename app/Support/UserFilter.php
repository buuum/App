<?php

namespace App\Support;

use Buuum\Dispatcher;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use League\Container\Container;

class UserFilter
{

    private $session;
    private $router;

    public function __construct(Container $container)
    {
        $this->session = $container->get("session");
        $this->router = $container->get("router");
    }

    public function notVisibleWithoutLogin()
    {
        if (!$this->session->get('login', false)) {
            return new RedirectResponse($this->router->getUrlRequest('login'));
        }
    }

    public function notVisibleWithLogin()
    {
        if ($this->session->get('login', false)) {
            return new RedirectResponse($this->router->getUrlRequest('home'));
        }
    }

    public function notVisibleWithLoginWeb()
    {
        if ($this->session->get('login', false)) {
            return new RedirectResponse($this->router->getUrlRequest('homeuser'));
        }
    }

}