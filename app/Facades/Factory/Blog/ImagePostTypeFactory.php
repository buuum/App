<?php

namespace App\Facades\Factory\Blog;

use App\Facades\Facade;

class ImagePostTypeFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\Blog\ImagePostTypeFactory();
    }

    /**
     * @return \App\Factory\Blog\ImagePostTypeFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}