<?php

namespace App\Facades\Factory;

use App\Facades\Facade;

class UserFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\UserFactory();
    }

    /**
     * @return \App\Factory\UserFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}