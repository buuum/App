<?php

namespace Application\Provider;

use Buuum\AbstractRepository;
use Database\Connectors\ConnectionFactory;
use League\Container\Container;

class DBProvider
{

    public function register(Container $app)
    {
        $app->share('database', function () use ($app) {
            $factory = new ConnectionFactory();

            $default = [
                'driver'    => 'mysql',
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                // Don't connect until we execute our first query
                'lazy'    => true,
                // Set PDO attributes after connection
                'options' => [
                    \PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    \PDO::ATTR_EMULATE_PREPARES   => true,
                ]
            ];

            $config = $app->get('config');
            $properties = array_merge($default, $config->getDatabase());

            $connection = $factory->make($properties);

            return $connection;
        });

        //AbstractRepository::setConnection($app->get('database'));
        //AbstractRepository::setsCache($app->get('cache'));
    }

}