<?php

namespace App\Facades\Handler;

use App\Facades\Facade;

class CountryHandler extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Handler\CountryHandler();
    }

    /**
     * @return \App\Handler\CountryHandler
     */
    public static function get()
    {
        return parent::getInstance();
    }
}