<?php

namespace App\Facades\Factory;

use App\Facades\Facade;

class CountryFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\CountryFactory();
    }

    /**
     * @return \App\Factory\CountryFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}