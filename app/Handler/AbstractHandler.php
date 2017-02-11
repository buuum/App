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
}