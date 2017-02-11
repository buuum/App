<?php

namespace App\Facades\Factory\Blog;

use App\Facades\Facade;

class CategoryFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return new \App\Factory\Blog\CategoryFactory();
    }

    /**
     * @return \App\Factory\Blog\CategoryFactory();
     */
    public static function get()
    {
        return parent::getInstance();
    }
}