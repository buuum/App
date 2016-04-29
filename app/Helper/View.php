<?php

namespace Application\Helper;

class View
{

    public function __construct($dir, $urls, $config)
    {
        $this->dir = $dir;
        $this->urls = $urls;
        $this->config = $config;
    }

    public function render($scope, $view, array $data = array(), $layout, $header = null)
    {
        extract($data);

        $view = $this->dir . '/' . $scope . '/public/' . $view . '.php';
        if ($layout) {
            $layout = $this->dir . '/' . $scope . '/public/' . $layout . '.php';
        } else {
            $layout = $view;
        }
        ob_start();
        include $layout;
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

}