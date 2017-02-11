<?php

namespace App\HandlerCollection\Blog;

use App\Handler\Blog\TagHandler;
use App\HandlerCollection\HandlerCollectionAbstract;

class TagHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = TagHandler::class;

}