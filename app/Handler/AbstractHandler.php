<?php

namespace App\Handler;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractHandler implements \JsonSerializable
{

    /**
     * @var Model
     */
    protected $model;

    public function delete()
    {
        $this->model->delete();
    }

    public function save()
    {
        $this->model->save();
    }

    public function toArray()
    {
        return $this->model->toArray();
    }

    public function __get($name)
    {
        return $this->model->$name;
    }

    public function jsonSerialize()
    {
        return $this->model->toArray();
    }

    public function getRelatedIds($related)
    {
        return $this->model->$related->pluck('id')->toArray();
    }

    public function setAppends($appends)
    {
        $this->model->setAppends($appends);
    }

    public function makeHidden($hiddens)
    {
        $this->model->makeHidden($hiddens);
    }

    /**
     * @param string $handlerClass
     * @param $handler AbstractHandler|int
     * @return mixed
     */
    protected function getIdFromHandlerOrId(string $handlerClass, $handler)
    {
        return ($handler instanceof $handlerClass) ? $handler->id : $handler;
    }
}