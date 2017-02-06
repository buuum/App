<?php

namespace App\Facades\Factory;

use App\Facades\Facade;

class RolFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\RolFactory();
    }

    /**
     * @return \App\Factory\RolFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}