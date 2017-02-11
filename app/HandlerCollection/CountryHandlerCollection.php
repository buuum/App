<?php

namespace App\HandlerCollection;

use App\Handler\CountryHandler;

class CountryHandlerCollection extends HandlerCollectionAbstract
{
    protected $handlerclass = CountryHandler::class;


}