<?php

namespace App\Controller\Adm\Country;

use App\Controller\Adm\Controller;
use App\Facades\Factory\CountryFactory;
use App\ViewsBuilder\Adm\Pages\CountryPage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new CountryPage($this->prepareData([
            'countries' => CountryFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}
