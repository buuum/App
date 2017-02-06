<?php

namespace App\Facades;

abstract class Facade
{
    protected static $instances = [];

    public static function __callStatic($method, $arguments)
    {

        $instance = self::getInstance();
        return call_user_func([$instance, $method], ...$arguments);
    }

    protected static function getInstance()
    {
        $class = static::class;
        if (empty(static::$instances[$class])) {
            static::$instances[$class] = static::getFacadeAccessor();
        }

        return static::$instances[$class];
    }
}