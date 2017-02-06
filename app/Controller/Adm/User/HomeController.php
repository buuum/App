<?php

namespace App\Controller\Adm\User;

use App\Controller\Adm\Controller;
use App\Facades\Factory\UserFactory;
use App\ViewsBuilder\Adm\Pages\UserPage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new UserPage($this->prepareData([
            'users' => UserFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}
