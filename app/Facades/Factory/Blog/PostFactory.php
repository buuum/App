<?php

namespace App\Facades\Factory\Blog;

use App\Facades\Facade;

class PostFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\Blog\PostFactory();
    }

    /**
     * @return \App\Factory\Blog\PostFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}