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
        $app->share('view', function () use ($app) {

            $config = $app->get('config');
            $locales = $config->get('environment.locales');

            $supportView = new ViewSupport($app);
            $supportView->defaultDateFormat = $locales['date'];
            $supportView->defaultNumberFormat = $locales['number'];
            $supportView->defaultTimeZone = $locales['timezone'];

            $view = new View($config->get("environment.host"), $supportView);
            \App\ViewsBuilder\View::setView($view);
            \App\ViewsBuilder\View::setRoute($app->get('router'));
            \App\ViewsBuilder\View::setConfig($app->get('config'));
            return $view;
        });

    }

}
