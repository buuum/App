<?php

namespace App\Factory;

use App\Handler\RolHandler;
use App\HandlerCollection\RolHandlerCollection;
use App\Model\RolModel;
use App\Validation\Rol;

class RolFactory extends AbstractFactory
{

    protected $modelclass = RolModel::class;
    protected $handlerclass = RolHandler::class;
    protected $handlercollectionclass = RolHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection($this->model->all());
    }

    public function getEdit($id)
    {
        return $this->getHandler($this->model->find($id));
    }

    public function build($data)
    {
        $handler = $this->getHandler(new RolModel());
        $handler->create($data);
    }

}