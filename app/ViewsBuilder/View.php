<?php

namespace App\ViewsBuilder;

use Buuum\Config;
use Buuum\Dispatcher;

class View
{

    /**
     * @var \Buuum\Template\View
     */
    protected static $view;

    /**
     * @var \Buuum\Dispatcher
     */
    protected static $router;

    /**
     * @var \Buuum\Config
     */
    protected static $config;

    public static function setView(\Buuum\Template\View $view)
    {
        self::$view = $view;
    }

    public static function setRoute(Dispatcher $router)
    {
        self::$router = $router;
    }

    public static function setConfig(Config $config)
    {
        self::$config = $config;
    }

    public function __construct()
    {
    }

    protected function getView()
    {
        return self::$view;
    }

    protected function getRoute()
    {
        return self::$router;
    }

    protected function getConfig()
    {
        return self::$config;
    }

    protected function render($view, $data)
    {
        return $this->getView()->render($view, $data, false);
    }

    protected function simpleHeader($title, $description)
    {
        $this->defaultHeader();
        $this->getView()->header->title($title)->description($description);
    }

    protected function getHeaderMenu($options = [])
    {
        return $this->render('menu/headermenu', $options);
    }

    protected function getFooter($options = [])
    {
        return $this->render('menu/footer', $options);
    }

    protected function getBreadCrumb($options)
    {
        return $this->render('breadcrumb', [
            'breadcrumb' => $options
        ]);
    }

    protected function renderLayout($layout, $page, $GA)
    {
        return $this->render($layout, [
            'page' => $page,
            'GA'   => $GA
        ]);
    }

    protected function defaultHeader()
    {
        $this->getView()->header
            ->title('Testamus')
            ->description('Testamus')
            ->keywords('')
            ->plugins([
                'jquery',
                'bootstrap',
                'font-awesome',
                'buuummodal',
                'jquery-ui-draggable',
                'jquery-ui-droppable',
                'jQuery-snapPuzzle',
                'jquery-knob',
                'masonry',
                'imagesloaded'
            ]);
    }

}