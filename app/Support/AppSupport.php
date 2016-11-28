<?php

namespace App\Support;

use Buuum\Config;
use Sepia\FileHandler;
use Sepia\PoParser;

class AppSupport
{

    /**
     * @var Config
     */
    private static $config;

    public static function setConfig(Config $config)
    {
        self::$config = $config;
    }

    public static function get($name)
    {
        return self::$config->get($name);
    }


}