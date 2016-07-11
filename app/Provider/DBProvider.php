<?php

namespace App\Provider;

use Illuminate\Database\Capsule\Manager;
use League\Container\Container;

class DBProvider
{

    public function register(Container $app)
    {
        $app->share('database', function () use ($app) {

            //https://siipo.la/blog/how-to-use-eloquent-orm-migrations-outside-laravel

            $default = [
                'driver'    => 'mysql',
                'host'      => 'localhost',
                'charset'   => 'utf8',
                'collation' => 'utf8_general_ci',
                'prefix'    => ''
            ];

            $config = $app->get('config');
            $env = $config->get('environment');
            $database = $config->get("environments.$env.bbdd");
            $properties = array_merge($default, $database);

            $capsule = new Manager();
            $capsule->addConnection($properties);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            // set timezone for timestamps etc
            date_default_timezone_set('UTC');
            return $capsule;
        });
        $app->get('database');
    }

}