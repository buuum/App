<?php

namespace App\HandlerCollection\Blog;

use App\Handler\Blog\PostHandler;
use App\HandlerCollection\HandlerCollectionAbstract;

class PostHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = PostHandler::class;

}