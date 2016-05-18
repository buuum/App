<?php

namespace Application\Provider;

use Application\Support\ViewSupport;
use Buuum\Template\Header;
use Buuum\Template\View;
use League\Container\Container;

class ViewProvider
{
    public function register(Container $app)
    {
        $app->share('view', function () use ($app) {

            $config = $app->get('config');
            $paths = $app->get('paths');

            $scope = $config->get('scope');

            $dir = $paths['views'] . '/' . $scope . '/public';

            $supportView = new ViewSupport($app);

            $view = new View($dir, $supportView);
            return $view;
        });

        $app->share('header', function () use ($app) {
            $config = $app->get('config');

            $debug = false;
            if ($config->get('environment.development')) {
                $paths = $app->get('paths');
                $version = json_decode($paths['version'], true);
                $debug = $version['version'];
            }
            return new Header($config->get("environment.host"), $config->get('scope'), $debug);
        });
    }

}