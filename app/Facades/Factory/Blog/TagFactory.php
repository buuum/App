<?php

namespace App\Facades\Factory\Blog;

use App\Facades\Facade;

class TagFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\Blog\TagFactory();
    }

    /**
     * @return \App\Factory\Blog\TagFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}