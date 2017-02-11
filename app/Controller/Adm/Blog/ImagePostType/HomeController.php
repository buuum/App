<?php

namespace App\Controller\Adm\Blog\ImagePostType;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\ImagePostTypeFactory;
use App\ViewsBuilder\Adm\Pages\ImagePostTypePage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new ImagePostTypePage($this->prepareData([
            'imagesposttypes' => ImagePostTypeFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}
