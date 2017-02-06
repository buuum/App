<?php

namespace App\Filter;

use App\Controller\Web\ErrorController;
use Buuum\Dispatcher;
use League\Container\Container;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class Filter
{

    /**
     * @var Container
     */
    protected $container;
    /**
     * @var Dispatcher
     */
    protected $router;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->router = $this->container->get('router');
        $this->session = $this->container->get('session');
        $this->request = $this->container->get('current_request');
    }


    protected function getError($type)
    {
        $error = new ErrorController($this->container);
        if ($type == 404) {
            return $error->error404();
        }
        return $error->error405();
    }

}