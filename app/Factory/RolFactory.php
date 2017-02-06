<?php

namespace App\Factory;

use App\Model\RolModel;

class RolFactory extends AbstractFactory
{
    public function __construct()
    {
        parent::__construct(new RolModel());
    }

    public function getList()
    {
        return RolModel::all();
    }

    public function getEdit($id)
    {
        return $this->model->find($id);
    }

    public function build($data)
    {
        $rol = new RolModel();
        $rol->rol = $data['rol'];

        $rol->save();
    }

}