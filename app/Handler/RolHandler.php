<?php

namespace App\Handler;

use App\Model\RolModel;

class RolHandler extends AbstractHandler
{
    public function __construct(RolModel $rol)
    {
        $this->model = $rol;
    }

    public function create($data)
    {
        $this->model->rol = $data['rol'];
        $this->model->save();
    }

    public function edit($data)
    {
        $this->model->rol = $data['rol'];
        $this->model->update();
    }

}
