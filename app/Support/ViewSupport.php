<?php

namespace App\Support;

use Buuum\Template\ParseViewInterface;
use League\Container\Container;

class ViewSupport implements ParseViewInterface
{

    private $container;
    private $config;
    private $view_path;

    private $scope;
    private $host;

    private $dispatcher;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->config = $this->container->get('config');

        $paths = $this->container->get('paths');
        $this->view_path = $paths['views'];

        $this->scope = $this->config->get('scope');
        $this->host = $this->config->get('environment.host');

        $this->dispatcher = $this->container->get('Buuum\Dispatcher');
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
        return "//" . $this->host . "/assets/" . $this->scope;
    }

    public function getUrl($name, $options = [])
    {
        return $this->dispatcher->getUrlRequest($name, $options);
    }

    public function isPageActual($name, $classname)
    {
        if ($last = $this->dispatcher->getLastPage()) {
            if ($last['name'] == $name) {
                return $classname;
            }
        }

        return '';
    }

    public function getViewsPath()
    {
        return $this->view_path . '/' . $this->scope . '/public';
    }

    public function getLink($type, $host, $files)
    {
        $files = base64_encode(implode(',', $files));
        $scope = $this->scope;
        $version = 0;
        if (!$this->config->get("environment.development")) {
            $paths = $this->config->get('paths');
            $version = json_decode(file_get_contents($paths['version']), true);
            $version = $version['version'];
        }
        return "//$host/assets/$type.php?f=$scope&p=$files&pre=$version";
    }

    public function pageActualStartsWith($name, $classname)
    {

        if ($last = $this->dispatcher->getLastPage()) {
            $url = $this->dispatcher->getUrlRequest($name);
            $parts = parse_url($url);
            $path = $parts['path'];

            if (substr($last['uri'], 0, strlen($path)) == $path) {
                return $classname;
            }
        }

        return '';
    }
}