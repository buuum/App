<?php

namespace App\Support;

use Buuum\Dispatcher;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use League\Container\Container;

class TestFilter
{

    private $session;
    private $router;

    public function __construct(Container $container)
    {
        $this->session = $container->get("session");
        $this->router = $container->get("router");
    }

    public function checkAction($_requesturi, $_prefix, $id, $idaction)
    {
        //dd($_requesturi, $_prefix, $id, $idaction);
        //return new RedirectResponse($this->router->getUrlRequest('home'));
    }

}