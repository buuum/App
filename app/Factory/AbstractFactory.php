<?php

namespace App\Factory;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AbstractFactory
{

    /**
     * @var Model
     */
    protected $model;
    protected $modelclass;
    protected $handlerclass;
    protected $handlercollectionclass;

    public function __construct()
    {
        $this->model = new $this->modelclass();
    }

    public function find($id)
    {
        return $this->getHandler($this->model->find($id));
    }

    public function getByField($field, $value)
    {
        if (!$user = $this->model->where($field, $value)->first()) {
            return false;
        }
        return $this->getHandler($user);
    }

    public function getAll()
    {
        return $this->getHandlerCollection($this->model->all());
    }

    public function getAllWithoutMe($id)
    {
        return $this->getHandlerCollection($this->model->where('id', '!=', $id)->get());
    }

    public function getHandler(Model $model)
    {
        return new $this->handlerclass($model);
    }

    public function getHandlerCollection(Collection $collection)
    {
        return new $this->handlercollectionclass($collection);
    }

}