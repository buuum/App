<?php

namespace App\HandlerCollection\Blog;

use App\Handler\Blog\ImagePostHandler;
use App\HandlerCollection\HandlerCollectionAbstract;

class ImagePostHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = ImagePostHandler::class;

}