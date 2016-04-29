<?php

namespace Application\Provider;

use Buuum\Cache;
use Doctrine\Common\Cache\ApcuCache;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use League\Container\Container;

class CacheProvider
{

    public function register(Container $app)
    {
        $app->share('cache', function () use ($app) {
            $paths = $app->get('paths');
            $config = $app->get('config');
            if ($config->get('cache') == 'apcu') {
                $cache = new ApcuCache();
            } elseif ($config->get('cache') == 'file') {
                $cache = new FilesystemCache($paths['storage'] . '/bbdd');
            } else {
                $cache = new ArrayCache();
            }
            return new Cache($cache);
        });
    }

}