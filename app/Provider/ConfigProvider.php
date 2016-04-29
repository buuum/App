<?php

namespace Application\Provider;

use Application\Helper\Config;
use League\Container\Container;

class ConfigProvider
{

    public function register(Container $app)
    {
        $app->share('config', function () use ($app) {
            $paths = $app->get('paths');
            return new Config($paths);
        });
    }

}