<?php

namespace App\Facades\Handler;

use App\Facades\Facade;

class RolHandler extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Handler\RolHandler();
    }

    /**
     * @return \App\Handler\RolHandler
     */
    public static function get()
    {
        return parent::getInstance();
    }
}