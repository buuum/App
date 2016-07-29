<?php

namespace App\Controller;

use App\Form\AbstractForm;
use Buuum\Config;
use Buuum\Dispatcher;
use Buuum\Template\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

abstract class AbstractController
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
    /**
     * @var AbstractForm
     */
    protected $form;

    public function __construct(View $view, Request $request, Session $session, Dispatcher $router, Config $config)
    {
        $this->session = $session;
        $this->flash = $session->getFlashBag();
        $this->view = $view;
        $this->request = $request;
        $this->router = $router;
        $this->config = $config;
        $this->initialize();
    }

    public function initialize()
    {
        $this->setDefaultHeader();
    }

    public function setDefaultHeader()
    {
        $this->view->header
            ->title('Buuum')
            ->description('Buuum App')
            ->keywords('')
            ->plugins(['jquery', 'bootstrap', 'font-awesome']);
    }

    public function render($view, array $data = array(), $layout = 'layout')
    {
        return $this->view->render($view, $data, $layout);
    }

}