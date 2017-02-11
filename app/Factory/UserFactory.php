<?php

namespace App\Factory;

use App\Handler\UserHandler;
use App\HandlerCollection\UserHandlerCollection;
use App\Model\UserModel;

class UserFactory extends AbstractFactory
{

    protected $modelclass = UserModel::class;
    protected $handlerclass = UserHandler::class;
    protected $handlercollectionclass = UserHandlerCollection::class;

    public function getList()
    {
        return $this->getHandlerCollection($this->model->all());
    }

    public function getEdit($id)
    {
        //UserModel::$add_appends = ['dia', 'mes', 'ano'];

        if (!$user = UserModel::with(['roles', 'pais'])->where('id', $id)->first()) {
            return false;
        }

        return $this->getHandler($user);

    }

    public function build($data)
    {
        $handler = new UserHandler(new UserModel());
        $handler->create($data);
        return $handler;
    }

    public function buildFromAdmin($data)
    {
        $handler = $this->getHandler(new UserModel());
        $handler->create($data);
        return $handler;
    }

}