<?php

namespace App\Handler;

use App\Model\RolModel;

class RolHandler extends BaseHandler
{
    public function __construct()
    {
        parent::__construct(new RolModel());
    }

    public function edit(RolModel $rol, $data)
    {
        $rol->rol = $data['rol'];
        $rol->update();
    }
}
