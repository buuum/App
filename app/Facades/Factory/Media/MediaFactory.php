<?php

namespace App\Facades\Factory\Media;

use App\Facades\Facade;

class MediaFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\Media\MediaFactory();
    }

    /**
     * @return \App\Factory\Media\MediaFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}