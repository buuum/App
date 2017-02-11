<?php

namespace App\HandlerCollection\Blog;

use App\Handler\Blog\ImagePostTypeHandler;
use App\HandlerCollection\HandlerCollectionAbstract;

class ImagePostTypeHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = ImagePostTypeHandler::class;

}