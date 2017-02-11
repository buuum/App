<?php

namespace App\HandlerCollection\Media;

use App\Handler\Media\MediaTypeHandler;
use App\HandlerCollection\HandlerCollectionAbstract;

class MediaTypeHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = MediaTypeHandler::class;

}