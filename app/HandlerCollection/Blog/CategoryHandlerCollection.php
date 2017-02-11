<?php

namespace App\HandlerCollection\Blog;

use App\Handler\Blog\CategoryHandler;
use App\HandlerCollection\HandlerCollectionAbstract;

class CategoryHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = CategoryHandler::class;

}