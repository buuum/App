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

    protected $data;

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

    public function __construct($data = null)
    {
        $this->data = $this->prepareData($data);
    }

    protected function render($view, $data = null)
    {
        return $this->getView()->render(static::translateView($view), $data, false);
    }

    public static function static_render($view, $data = null)
    {
        return self::$view->render(static::translateView($view), $data, false);
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

    protected function renderLayout($layout, $page, $headers = null)
    {
        return $this->render($layout, [
            'page'        => $page,
            'add_headers' => $headers
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
                'bootstrap-material-design'
            ]);
    }

    /**
     * Imprime los headers necesarios para hacer like en fb correctamente
     *
     * @access public
     * @param string $titulo
     * @param string $url
     * @param string $image Url de la imagen (OPCIONAL)
     * @param string $desc Descripcion (OPCIONAL)
     * @param string $type
     *
     * @return string Metas para imprimir en el header
     *
     */
    protected function renderHeaderFacebook($titulo, $url, $image = '', $desc = '', $type = 'article')
    {

        return $this->render("headers/facebook", [
            'titulo'   => $titulo,
            'type'     => $type,
            'url'      => $url,
            'image'    => $image,
            'sitename' => $this->getConfig()->get('environment.site_name'),
            'desc'     => $desc,
            'fbapi'    => $this->getConfig()->get('environment.facebook.api_id')
        ]);
    }

    protected function prepareData($data, $asArray = false)
    {
        if (!is_string($data)) {
            return [];
        }

        return json_decode($data, $asArray);

    }

    protected static function translateView($view)
    {
        return $view;
    }
}