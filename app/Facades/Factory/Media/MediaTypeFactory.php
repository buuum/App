<?php

namespace App\Facades\Factory\Media;

use App\Facades\Facade;

class MediaTypeFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\Media\MediaTypeFactory();
    }

    /**
     * @return \App\Factory\Media\MediaTypeFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}