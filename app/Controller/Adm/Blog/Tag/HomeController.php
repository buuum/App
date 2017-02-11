<?php

namespace App\Controller\Adm\Blog\Tag;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\TagFactory;
use App\ViewsBuilder\Adm\Pages\TagPage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new TagPage($this->prepareData([
            'tags' => TagFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}
