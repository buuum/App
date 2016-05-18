<?php

namespace Application\Support;

use Buuum\Template\ParseViewInterface;
use League\Container\Container;

class ViewSupport implements ParseViewInterface
{

    private $container;
    private $config;
    private $scope;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->config = $this->container->get('config');
        $this->scope = $this->config->get('scope');
    }

    public function getText($text, $params = [])
    {
        if (!empty($params)) {
            $txt = vsprintf(_e($text), $params);
        } else {
            $txt = _e($text);
        }
        return $txt;
    }

    public function getImgPath()
    {
        return "//" . $this->config->get('environment.host') . "/assets/" . $this->scope;
    }

    public function getUrl($name, $options = [])
    {
        return $this->container->get('router')->getUrlRequest($name, $options);
    }

    public function isPageActual($name, $classname)
    {
        if ($this->container->get('router')->isPageActual($name)) {
            return $classname;
        }
        return '';
    }
}