<?php

namespace App\Controller\Adm\Rol;

use App\Controller\Adm\Controller;
use App\Facades\Handler\RolHandler;
use App\ViewsBuilder\Adm\Pages\RolPage;

class DeleteController extends Controller
{

    public function get($rol)
    {
        $pagina = new RolPage($this->prepareData([
            'rol' => $rol
        ]));
        return [
            'error' => false,
            'html'  => $pagina->delete()
        ];
    }

    public function delete($rol)
    {
        RolHandler::get()->remove($rol);
        return [
            'error' => false,
            'id'    => $rol->id
        ];
    }

}
