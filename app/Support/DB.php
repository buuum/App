<?php

namespace App\Support;

use Illuminate\Database\Capsule\Manager;

class DB
{

    /**
     * @var Manager
     */
    private static $capsule;

    /**
     * @param Manager $capsule
     */
    public static function setCapsule(Manager $capsule)
    {
        self::$capsule = $capsule;
    }

    /**
     * @param $methods
     * @param $arguments
     * @return mixed
     */
    public function __call($methods, $arguments)
    {
        return self::$capsule->$methods(...$arguments);
    }

    /**
     * @param $methods
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($methods, $arguments)
    {
        $capsule = self::$capsule;
        return $capsule::$methods(...$arguments);
    }

}