<?php

namespace App\Controller\Adm\Blog\Post;

use App\Controller\Adm\Controller;
use App\Facades\Factory\Blog\PostFactory;
use App\ViewsBuilder\Adm\Pages\PostPage;

class HomeController extends Controller
{

    public function get()
    {
        $page = new PostPage($this->prepareData([
            'posts' => PostFactory::get()->getList()
        ]));
        return $page->showlist();
    }

}
