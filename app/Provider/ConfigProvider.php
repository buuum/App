<?php

namespace Application\Provider;

use Application\Support\HandleError;
use Buuum\Config;
use League\Container\Container;

class ConfigProvider
{

    public function register(Container $app)
    {
        $app->share('config', function () use ($app) {
            $paths = $app->get('paths');

            $configs = require_once $paths['config'];
            $app_path = $paths['app'];

            $autoloads = [
                "files" => [$app_path . '/helpers.php'],
                //"psr-4" => [
                //    "Application\\" => $app_path
                //]
            ];

            $config = new Config($configs, $autoloads);

            $env = $config->get('environment');
            $debugMode = $config->get("$env.development");

            $config->set("environment.development", $debugMode);
            $config->set("environment.host", $config->get("$env.host"));

            $handle = new HandleError($debugMode, $paths['log']);
            $config->setupErrors($handle);

            return $config;
        });
    }

}