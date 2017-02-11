<?php

namespace App\Controller\Adm\Blog\ImagePost;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\ImagePostFactory;
use App\ViewsBuilder\Adm\Pages\ImagePostPage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new ImagePostPage($this->prepareData([
            'imagespost' => ImagePostFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}
