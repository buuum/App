<?php

namespace App\Facades\Factory\Media;

use App\Facades\Facade;

class MediaVariantFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\Media\MediaVariantFactory();
    }

    /**
     * @return \App\Factory\Media\MediaVariantFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}