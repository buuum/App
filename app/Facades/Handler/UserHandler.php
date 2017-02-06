<?php

namespace App\Facades\Handler;

use App\Facades\Facade;

class UserHandler extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Handler\UserHandler();
    }

    /**
     * @return \App\Handler\UserHandler
     */
    public static function get()
    {
        return parent::getInstance();
    }
}