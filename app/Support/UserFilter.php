<?php

namespace App\Support;

use Symfony\Component\HttpFoundation\RedirectResponse;
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
            return [
                'passed'   => false,
                'response' => new RedirectResponse($this->router->getUrlRequest('login'))
            ];
        }
    }

    public function notVisibleWithLogin()
    {
        if ($this->session->get('login', false)) {
            return [
                'passed'   => false,
                'response' => new RedirectResponse($this->router->getUrlRequest('home'))
            ];
        }
    }

    public function notVisibleWithLoginWeb()
    {
        if ($this->session->get('login', false)) {
            return [
                'passed'   => false,
                'response' => new RedirectResponse($this->router->getUrlRequest('homeuser'))
            ];
        }
    }

}