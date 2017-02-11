<?php

namespace App\Controller\Adm\Blog\Category;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\CategoryFactory;
use App\ViewsBuilder\Adm\Pages\CategoryPage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new CategoryPage($this->prepareData([
            'categories' => CategoryFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}
