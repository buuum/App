<?php

namespace App\Controller\Adm;

use Buuum\Config;
use Buuum\Dispatcher;
use Buuum\Template\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use League\Container\Container;

class Controller
{

    /**
     * @var Session
     */
    public $session;
    /**
     * @var View
     */
    public $view;
    /**
     * @var Request
     */
    public $request;
    /**
     * @var Dispatcher
     */
    public $router;
    /**
     * @var Config
     */
    public $config;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->session = $this->container->get('session');
        $this->flash = $this->session->getFlashBag();
        $this->view = $this->container->get('view');
        $this->request = $this->container->get('current_request');
        $this->router = $this->container->get('router');
        $this->config = $this->container->get('config');
        $this->platform = $this->config->get('environment.platform');
    }

    protected function prepareData($options = [])
    {
        $data = array_merge($options, [
            'usersingin' => $this->session->get('user'),
            'flash_vars' => $this->flash->all()
        ]);

        return json_encode($data);
    }
}