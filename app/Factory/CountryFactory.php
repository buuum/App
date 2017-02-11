<?php

namespace App\Factory;

use App\Handler\CountryHandler;
use App\HandlerCollection\CountryHandlerCollection;
use App\Model\CountryModel;

class CountryFactory extends AbstractFactory
{

    protected $modelclass = CountryModel::class;
    protected $handlerclass = CountryHandler::class;
    protected $handlercollectionclass = CountryHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection(CountryModel::all());
    }

    public function getEdit($id)
    {
        return $this->getHandler($this->model->find($id));
    }

    public function build($data)
    {
        $handler = $this->getHandler(new CountryModel());
        $handler->create($data);
    }

}