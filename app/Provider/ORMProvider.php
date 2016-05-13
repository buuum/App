<?php

namespace Application\Provider;


use Buuum\AbstractRepository;
use Buuum\Adapter\CacheAdapter;
use Buuum\Adapter\DatabaseAdapter;
use League\Container\Container;

class ORMProvider
{

    public function register(Container $app)
    {

        $adapter_connection = new DatabaseAdapter($app->get('database'));
        $cache_adatpter = new CacheAdapter($app->get('cache'));

        AbstractRepository::setConnection($adapter_connection);
        AbstractRepository::setCache($cache_adatpter);

    }

}