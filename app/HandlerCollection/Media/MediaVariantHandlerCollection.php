<?php

namespace App\HandlerCollection\Media;

use App\Handler\Media\MediaVariantHandler;
use App\HandlerCollection\HandlerCollectionAbstract;

class MediaVariantHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = MediaVariantHandler::class;

}