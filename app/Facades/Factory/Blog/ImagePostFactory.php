<?php

namespace App\Facades\Factory\Blog;

use App\Facades\Facade;

class ImagePostFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\Blog\ImagePostFactory();
    }

    /**
     * @return \App\Factory\Blog\ImagePostFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}