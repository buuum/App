<?php

namespace App\HandlerCollection;

use App\Handler\UserHandler;

class UserHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = UserHandler::class;



}