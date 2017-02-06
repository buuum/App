<?php

namespace App\Factory;

class AbstractFactory
{

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getByField($field, $value)
    {
        return $this->model->where($field, $value)->first();
    }

    public function getByFields($data)
    {
        return $this->model->where($data)->first();
    }

    public function getAll()
    {
        return $this->model->all();
    }
}