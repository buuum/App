<?php

namespace App\Support;

use Buuum\Dispatcher;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class UserFilter
{

    private $session;
    private $router;

    public function __construct(Session $session, Dispatcher $router)
    {
        $this->session = $session;
        $this->router = $router;
    }

    public function needLogin()
    {
        if(!$this->session->get('login', false)){
            return new RedirectResponse($this->router->getUrlRequest('login'));
        }
    }

    public function withLogin()
    {
        if($this->session->get('login', false)){
            return new RedirectResponse($this->router->getUrlRequest('homeuser'));
        }
    }
}