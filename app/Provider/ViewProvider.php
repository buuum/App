<?php

namespace App\Provider;

use App\Support\ViewSupport;
use Buuum\Template\Header;
use Buuum\Template\View;
use League\Container\Container;

class ViewProvider
{
    public function register(Container $app)
    {
        $app->share('Buuum\Template\View', function () use ($app) {

            $config = $app->get('config');

            $supportView = new ViewSupport($app);

            $view = new View($config->get("environment.host"), $supportView);
            return $view;
        });

    }

}