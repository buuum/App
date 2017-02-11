<?php

namespace App\Controller\Adm\Rol;

use App\Controller\Adm\Controller;
use App\Facades\Factory\RolFactory;
use App\Model\RolModel;
use App\ViewsBuilder\Adm\Pages\RolPage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new RolPage($this->prepareData([
            'roles' => RolFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}
