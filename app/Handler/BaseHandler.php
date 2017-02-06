<?php

namespace App\Handler;

use Illuminate\Database\Eloquent\Model;

abstract class BaseHandler
{
    /**
     * Model which it handles
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getByField($field, $value)
    {
        return $this->model->where($field, $value)->first();
    }

    public function remove($model)
    {
        $model->delete();
    }

    public function delete($id)
    {
        $item = $this->model->find($id);
        $item->delete();
    }

    public function get($id){
        return $this->getByField('id', $id);
    }

}
