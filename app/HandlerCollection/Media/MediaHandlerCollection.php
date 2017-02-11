<?php

namespace App\HandlerCollection\Media;

use App\Handler\Media\MediaHandler;
use App\HandlerCollection\HandlerCollectionAbstract;

class MediaHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = MediaHandler::class;

}