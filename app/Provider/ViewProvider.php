<?php

namespace Application\Provider;

use Application\Helper\Header;
use Application\Helper\View;
use League\Container\Container;

class ViewProvider
{
    public function register(Container $app)
    {
        $app->share('view', function() use ($app){
            $paths = $app->get('paths');
            $dir = $paths['views'];
            $view = new View($dir, $app->get('urls'), $app->get('config'));
            return $view;
        });

        $app->share('header', function() use ($app){
            $config = $app->get('config');
            return new Header($config->getHost(), $config->cssjsVersion());
        });

    }

}